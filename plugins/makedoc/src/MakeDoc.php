<?php

namespace Formwork\Plugins\MakeDoc;

use Formwork\Cms\App;
use Formwork\Fields\FieldFactory;
use Formwork\Parsers\Markdown;
use Formwork\Traits\StaticClass;
use Formwork\Utils\Arr;
use Formwork\Utils\Path;
use Formwork\Utils\Str;
use PHPStan\PhpDocParser\Ast\PhpDoc\ParamTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTagNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\PhpDocTextNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ReturnTagValueNode;
use PHPStan\PhpDocParser\Ast\PhpDoc\ThrowsTagValueNode;
use PHPStan\PhpDocParser\Lexer\Lexer;
use PHPStan\PhpDocParser\Parser\ConstExprParser;
use PHPStan\PhpDocParser\Parser\PhpDocParser;
use PHPStan\PhpDocParser\Parser\TokenIterator;
use PHPStan\PhpDocParser\Parser\TypeParser;
use PHPStan\PhpDocParser\ParserConfig;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionClass;
use ReflectionProperty;
use ReflectionType;
use InvalidArgumentException;
use UnitEnum;

class MakeDoc
{
    private PhpDocParser $phpDocParser;

    private Lexer $phpDocLexer;

    public function __construct(private string $baseUri, private bool $onlySummary = false)
    {
        $this->loadPhpDocParser();
    }

    /**
     * @param array<string, array{fqcn: class-string, includeInherited: bool}> $classes
     */
    public function generateClassesDocumentation(array $classes): string
    {
        $output = [];
        foreach ($classes as $alias => ['fqcn' => $class, 'includeInherited' => $includeInherited]) {
            $output[] = $this->generateClassDocumentation($alias, $class, $includeInherited, $classes[$alias]['excludeMethods'] ?? []);
        }
        return implode("\n", $output) . "\n";
    }

    public function generateFieldDocumentation(string $alias, string $type): string
    {
        $output = [];
        $output[] = '<div class="methods">';

        $field = App::instance()->getService(FieldFactory::class)->make($alias, ['type' => $type]);

        $methods = $field->getMethods();

        ksort($methods);

        foreach ($methods as $name => $value) {
            if (in_array($name, ['return', 'toString', 'setValue'], true)) {
                continue;
            }
            $output[] = '<div>';
            $output[] = $this->generateFunctionDocumentation(new ReflectionFunction($value), $alias, $name, ['field']);
            $output[] = '</div>';
        }

        $output[] = '</div>';
        return implode("\n", $output) . "\n";
    }

    /**
     * @return array{description: string, paramsDescription: array<string, string>, returnDescription: string, internal: bool}
     */
    private function parsePhpDoc(string $doc): array
    {
        $tokens = new TokenIterator($this->phpDocLexer->tokenize($doc));
        $phpDocNode = $this->phpDocParser->parse($tokens);

        $result = [
            'description'       => '',
            'paramsDescription' => [],
            'returnDescription' => '',
            'internal'          => false,
            'since'             => null,
        ];

        foreach ($phpDocNode->children as $child) {
            if ($child instanceof PhpDocTextNode) {
                $result['description'] .= $child->text;
            } elseif ($child instanceof PhpDocTagNode) {
                if ($child->value instanceof ParamTagValueNode && $child->value->description) {
                    $result['paramsDescription'][$child->value->parameterName] = $child->value->description;
                }
                if ($child->value instanceof ThrowsTagValueNode && $child->value->description) {
                    $result['throwsDescription'][][$child->value->type->name] = $child->value->description;
                }
                if ($child->value instanceof ReturnTagValueNode && $child->value->description) {
                    $result['returnDescription'] = $child->value->description;
                }
                if ($child->name === '@internal') {
                    $result['internal'] = true;
                }
                if ($child->name === '@since' && $child->value) {
                    $result['since'] = $child->value;
                }
            }
        }

        return $result;
    }

    /**
     * @param class-string $class
     * @param array<string> $excludeMethods
     */
    public function generateClassDocumentation(string $alias, string $class, bool $includeInherited, array $excludeMethods = []): string
    {
        $reflectionClass = new ReflectionClass($class);

        $methods = $reflectionClass->getMethods(ReflectionProperty::IS_PUBLIC);

        usort($methods, function ($a, $b) {
            return strcmp($a->getName(), $b->getName());
        });

        $output[] = '<div class="methods">';

        foreach ($methods as $method) {
            if (in_array($method->name, $excludeMethods, true)) {
                continue;
            }

            $traits = $reflectionClass->getTraitNames();
            if ($method->isConstructor() && (!$reflectionClass->isInstantiable() || in_array(StaticClass::class, $traits, true))) {
                continue; // Skip constructors of abstract classes
            }

            if ((!$method->isConstructor() && Str::startsWith($method->name, '__'))) {
                continue; // Skip magic methods
            }

            if (!$includeInherited && $method->class !== $class) {
                continue; // Skip methods inherited from parent classes
            }

            $methodDoc = $this->generateFunctionDocumentation($method, $alias, context: $reflectionClass);

            if ($methodDoc === '') {
                continue; // Skip methods with no documentation
            }

            $output[] = sprintf('<div>%s</div>', $methodDoc);
        }

        $output[] = '</div>';

        return implode("\n", $output) . "\n";
    }

    /**
     * @param array<string> $ignoreParams
     * @param ReflectionClass<object>|null $context
     */
    public function generateFunctionDocumentation(ReflectionMethod|ReflectionFunction $reflection, ?string $alias = null, ?string $name = null, array $ignoreParams = [], bool $outputLinks = true, ?ReflectionClass $context = null): string
    {
        $doc = $this->parsePhpDoc($reflection->getDocComment() ?: '/** */');

        $name ??= $reflection->getName();

        if ($reflection instanceof ReflectionMethod) {
            while ($reflection->hasPrototype() && !$doc['description']) {
                $reflection = $reflection->getPrototype();
                $doc['description'] = $this->parsePhpDoc($reflection->getDocComment() ?: '/** */')['description'];
            }

            if (!$doc['description']) {
                foreach ($reflection->getDeclaringClass()->getTraits() as $reflectionClass) {
                    if (!$reflectionClass->hasMethod($reflection->getName())) {
                        continue;
                    }
                    $traitMethod = $reflectionClass->getMethod($reflection->getName());
                    $doc = $this->parsePhpDoc($traitMethod->getDocComment() ?: '/** */');
                    if ($doc['description']) {
                        break;
                    }
                }
            }
        }

        if ($doc['internal']) {
            return '';
        }

        $uri = Path::join([$this->baseUri, strtolower((string) $alias), '/']);

        if ($reflection instanceof ReflectionMethod) {
            $className = $context?->getShortName() ?? $reflection->getDeclaringClass()->getShortName();
            $declaringClass = $reflection->getDeclaringClass()->getName();
            $alias ??= strtolower($reflection->getName());

            $id = sprintf('%s-%s', strtolower($alias), $name);


            if ($reflection->isConstructor()) {
                $output[] = $outputLinks ? sprintf('<h3 id="%2$s"><a href="%s#%s">new %s()</a></h3>', $uri, $id, $className) : sprintf('<h3 id="%s">new %s()</h3>', $id, $className);
            } else {
                $output[] = $outputLinks ? sprintf(
                    '<h3 id="%2$s"><a href="%s#%s">%s%s<wbr>%s()</a></h3>',
                    $uri,
                    $id,
                    $reflection->isStatic() ? $className : '$' . $alias,
                    htmlspecialchars($reflection->isStatic() ? '::' : '->'),
                    $name
                ) : sprintf(
                    '<h3 id="%s">%s%s<wbr>%s()</h3>',
                    $id,
                    $reflection->isStatic() ? $className : '$' . $alias,
                    htmlspecialchars($reflection->isStatic() ? '::' : '->'),
                    $name
                );
            }
        } else {
            $id = $alias ? sprintf('%s-%s', strtolower($alias), $name) : $name;

            if ($alias !== null) {
                $output[] = $outputLinks ? sprintf(
                    '<h3 id="%2$s"><a href="%s#%s">%s%s<wbr>%s()</a></h3>',
                    $uri,
                    $id,
                    '$' . $alias,
                    htmlspecialchars('->'),
                    $name
                ) : sprintf(
                    '<h3 id="%s">%s%s<wbr>%s()</h3>',
                    $id,
                    '$' . $alias,
                    htmlspecialchars('->'),
                    $name
                );
            } else {
                $output[] = $outputLinks ? sprintf(
                    '<h3 id="%2$s"><a href="%s#%s">%s()</a></h3>',
                    $uri,
                    $id,
                    $name
                ) : sprintf(
                    '<h3 id="%s">%s()</h3>',
                    $id,
                    $name
                );
            }
        }

        $output[] = '<div class="method-description">';

        if ($doc['description']) {
            $output[] = Markdown::parse($doc['description']);
        } elseif ($reflection instanceof ReflectionMethod && $reflection->isConstructor()) {
            $className = $context?->getShortName() ?? $reflection->getDeclaringClass()->getShortName();
            $output[] = sprintf('<p>Create a new instance of <code>%s</code></p>', $className);
        } else {
            $output[] = '<p>–</p>';
        }

        if ($doc['since']) {
            $output[] = sprintf('<span class="badge badge-yellow">Since %s</span>', $doc['since']);
        }

        $output[] = '</div>';

        if ($this->onlySummary) {
            return implode("\n", $output) . "\n";
        }

        $output[] = '<div class="method-details">';

        $output[] = sprintf('<pre class="method-signature"><code>%s</code></pre>', $this->formatFunctionSignature($reflection, $alias, $name, $ignoreParams, $context));

        if ($reflection->getNumberOfParameters() > 0 && Arr::some($reflection->getParameters(), fn($param) => !in_array($param->getName(), $ignoreParams, true))) {
            $output[] = $this->generateParamsDocumentation($reflection, $doc['paramsDescription'], $ignoreParams);
        }

        if ($reflection->hasReturnType()) {
            $methodReturnType = $reflection->getReturnType();
            $returnType = (string) $methodReturnType;
            if (isset($declaringClass) && ($returnType === 'static' || $returnType === 'self')) {
                $returnType = sprintf('<span class="type-name">%s</span>', $declaringClass);
            } else {
                $returnType = $this->formatType($methodReturnType, asKeyword: false);
            }
        } elseif ($reflection instanceof ReflectionMethod && $reflection->isConstructor()) {
            $returnType = sprintf('<span class="type-name">%s</span>', $declaringClass);
        } else {
            $returnType = '<span class="type-keyword">mixed</span>';
        }

        $output[] = '<h4>Return type</h4>';
        $output[] = sprintf('<p><code class="type">%s</code></p>', $returnType);
        if ($doc['returnDescription']) {
            $output[] = Markdown::parse($doc['returnDescription']);
        }

        if (isset($doc['throwsDescription'])) {
            $output[] = $this->generateExceptionsDocumentation($doc['throwsDescription'] ?? []);
        }

        $file = $reflection->getFileName();
        if (
            $file && ($startLine = $reflection->getStartLine()) && ($endLine = $reflection->getEndLine())
        ) {
            $output[] = '<h4>Reference</h4>';
            $output[] = sprintf(
                '<a href="https://github.com/getformwork/formwork/blob/2.x/formwork/%s#L%d-L%d">%1$s#L%2$d-L%3$d</a>',
                str_replace('\\', '/', Str::afterLast($file, '/formwork/')),
                $startLine,
                $endLine
            );
        }
        $output[] = '</div>';

        return implode("\n", $output) . "\n";
    }

    /**
     * @param array<string, string> $paramsDescription
     * @param array<string> $ignoreParams
     */
    private function generateParamsDocumentation(ReflectionMethod|ReflectionFunction $reflection, array $paramsDescription, array $ignoreParams = []): string
    {
        $output[] = '<h4>Parameters</h4>';
        $output[] = '<table class="params">';
        $output[] = '<tr><th>Name</th><th>Type</th><th>Default</th><th>Description</th></tr>';

        $params = $reflection->getParameters();

        foreach ($params as $param) {
            if (in_array($param->getName(), $ignoreParams, true)) {
                continue; // Skip ignored parameters
            }

            $name = $param->isVariadic() ? '...' : '';
            $name .= $param->isPassedByReference() ? '&' : '';
            $name .= '$' . $param->getName();
            $description = $paramsDescription[$name] ?? '–';

            $defaultValue = '–';

            if ($param->isDefaultValueAvailable()) {
                if ($param->isDefaultValueConstant() && ($const = $param->getDefaultValueConstantName()) !== null) {
                    $defaultValue = sprintf('<code class="type">%s</code>', $this->addWordBreaks($this->formatConstant($const)));
                } else {
                    $defaultValue = sprintf('<code  class="type">%s</code>', $this->formatValue($param->getDefaultValue()));
                }
            }

            $types = preg_replace_callback('/[^|&]+/', fn(array $matches) => sprintf('<code class="type">%s</code><wbr>', $this->addWordBreaks($matches[0])), $this->formatType($param->getType(), asKeyword: false));

            $output[] = '<tr>';
            $output[] = sprintf('<td><code class="is-param">%s</code></td>', $name);
            $output[] = sprintf('<td>%s</td>', $types);
            $output[] = sprintf('<td>%s</td>', $defaultValue);
            $output[] = sprintf('<td>%s</td>', $this->addWordBreaks(Markdown::parse($description)));
            $output[] = '</tr>';
        }
        $output[] = '</table>';
        return implode("\n", $output) . "\n";
    }

    private function generateExceptionsDocumentation(array $throwsDescription): string
    {
        $output[] = '<h4>Exceptions</h4>';
        $output[] = '<table class="params">';
        $output[] = '<tr><th>Type</th><th>Description</th></tr>';

        foreach ($throwsDescription as $entry) {
            foreach ($entry as $type => $description) {
                $types = preg_replace_callback('/[^|&]+/', fn(array $matches) => sprintf('<code class="type">%s</code><wbr>', $this->addWordBreaks($matches[0])), $this->formatTypeString($type, asKeyword: false));

                $output[] = '<tr>';
                $output[] = sprintf('<td>%s</td>', $types);
                $output[] = sprintf('<td>%s</td>', $this->addWordBreaks(Markdown::parse($description)));
                $output[] = '</tr>';
            }
        }
        $output[] = '</table>';
        return implode("\n", $output) . "\n";
    }

    private function addWordBreaks(string $text): string
    {
        // Add word breaks to long words to prevent overflow
        return preg_replace('/::|_|\\\\/', '<wbr>$0', $text) ?? $text;
    }

    private function formatType(?ReflectionType $reflectionType, bool $asKeyword = true): string
    {
        if ($reflectionType === null) {
            return '<code class="type"><span class="type-keyword">mixed</span></code>';
        }

        return $this->formatTypeString((string) $reflectionType, $asKeyword);
    }

    private function formatTypeString(string $type, bool $asKeyword = true): string
    {
        return preg_replace_callback('/\??([^|&]+)/', fn(array $matches) => match ($matches[1]) {
            'bool'     => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'bool', $matches[0]),
            'true'     => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'bool', $matches[0]),
            'false'    => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'bool', $matches[0]),
            'int'      => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'number', $matches[0]),
            'float'    => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'number', $matches[0]),
            'string'   => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'string', $matches[0]),
            'null'     => sprintf('<span class="type-%s">%s</span>', $asKeyword ? 'keyword' : 'null', $matches[0]),
            'array'    => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'mixed'    => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'void'     => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'object'   => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'resource' => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'never'    => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'callable' => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'iterable' => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'self'     => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'static'   => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            'parent'   => sprintf('<span class="type-keyword">%s</span>', $matches[0]),
            default    => sprintf('<span class="type-name">%s</span>', $matches[0]),
        }, $type) ?? throw new InvalidArgumentException('Invalid type string provided');
    }

    /**
     * Formats the function signature for display.
     * @template T of object
     * @param array<string> $ignoreParams
     * @param ReflectionClass<T>|null $context
     */
    private function formatFunctionSignature(ReflectionMethod|ReflectionFunction $reflection, ?string $alias = null, ?string $name = null, array $ignoreParams = [], ?ReflectionClass $context = null): string
    {
        $name ??= $reflection->getName();

        if ($reflection instanceof ReflectionMethod) {
            $declaringClass = $reflection->getDeclaringClass()->getName();
            $className = $context?->getShortName() ?? $reflection->getDeclaringClass()->getShortName();

            $operator = $reflection->isStatic() ? '::' : '->';
            $class = $reflection->isStatic() ? $className : '$' . $alias;

            if ($reflection->isConstructor()) {
                $signature = sprintf('<span class="type-keyword">new</span> <span class="type-name">%s</span>', $className);
            } else {
                $signature = sprintf('<span class="type-%s">%s</span>%s<span class="type-name">%s</span>', $reflection->isStatic() ? 'name' : 'var', $class, htmlspecialchars($operator), $name);
            }
        } else {
            if ($alias !== null) {
                $signature = sprintf('<span class="type-var">$%s</span>%s<span class="type-name">%s</span>', $alias, htmlspecialchars('->'), $name);
            } else {
                $signature = sprintf('<span class="type-name">%s</span>', $name);
            }
        }


        $signature .= '(';

        $params = [];
        foreach ($reflection->getParameters() as $parameter) {
            if (in_array($parameter->getName(), $ignoreParams, true)) {
                continue; // Skip ignored parameters
            }
            $type = $parameter->getType();
            $type = $type ? $this->formatType($type) : '<span class="type-keyword">mixed</span>';
            $name = $parameter->isVariadic() ? '...' : '';
            $name .= $parameter->isPassedByReference() ? '&' : '';
            $name .= sprintf('<span class="type-var">$%s</span>', $parameter->getName());
            if ($parameter->isDefaultValueAvailable()) {
                if ($parameter->isDefaultValueConstant() && ($constName = $parameter->getDefaultValueConstantName()) !== null) {
                    $const = $this->addWordBreaks($this->formatConstant($constName));

                    $name .= sprintf(' = %s', $const);
                } else {
                    $name .= sprintf(' = %s', $this->formatValue($parameter->getDefaultValue()));
                }
            }
            $params[] = "$type $name";
        }

        $signature .= implode(', ', $params) . ')';

        if ($reflection instanceof ReflectionMethod) {
            if ($reflection->isConstructor()) {
                return $signature;
            }

            if ($reflection->hasReturnType()) {
                $methodReturnType = $reflection->getReturnType();
                $returnType = (string) $methodReturnType;
                if ($returnType === 'static' || $returnType === 'self') {
                    $returnType = sprintf('<span class="type-name">%s</span>', $declaringClass);
                } else {
                    $returnType = $this->formatType($methodReturnType);
                }
            } else {
                $returnType = '<span class="type-keyword">mixed</span>';
            }
        } elseif ($reflection->hasReturnType()) {
            $methodReturnType = $reflection->getReturnType();
            $returnType = $this->formatType($methodReturnType);
        } else {
            $returnType = '<span class="type-keyword">mixed</span>';
        }

        $signature .= ': ' . $returnType;

        return $signature;
    }

    private function formatConstant(string $const): string
    {
        if (!defined($const)) {
            $const = Str::afterLast($const, '\\');
        }

        $parts = explode('::', $const);

        if (count($parts) === 2) {
            return sprintf('%s<span class="type-operator">::</span><span class="type-constant">%s</span>', $this->formatTypeString($parts[0]), $parts[1]);
        }

        return sprintf('<span class="type-constant">%s</span>', $parts[0]);
    }

    private function formatValue(mixed $value): string
    {
        switch (gettype($value)) {
            case 'boolean':
                return sprintf('<span class="type-bool">%s</span>', $value ? 'true' : 'false');
            case 'integer':
                return sprintf('<span class="type-number">%d</span>', $value);
            case 'double':
                return sprintf('<span class="type-number">%f</span>', $value);
            case 'string':
                return sprintf('<span class="type-string">\'%s\'</span>', htmlspecialchars($value));
            case 'NULL':
                return '<span class="type-null">null</span>';
            case 'array':
                $formattedArray = [];
                foreach ($value as $key => $val) {
                    if (is_string($key)) {
                        $formattedArray[] = sprintf('%s => %s', $this->formatValue($key), $this->formatValue($val));
                    } elseif (is_int($key)) {
                        $formattedArray[] = $this->formatValue($val);
                    }
                }
                return sprintf('<span class="type-array">[</span>%s<span class="type-array">]</span>', implode(', ', $formattedArray));
            case 'object':
                if ($value instanceof UnitEnum) {
                    return sprintf('<span class="type-name">%s::%s</span>', $value::class, $value->name);
                }
                return sprintf('<span class="type-name">%s</span>', $value::class);
            default:
                return sprintf('<span class="type-name">%s</span>', $value::class);
        }
    }

    private function loadPhpDocParser(): void
    {
        $parserConfig = new ParserConfig(usedAttributes: []);
        $this->phpDocLexer = new Lexer($parserConfig);
        $constExprParser = new ConstExprParser($parserConfig);
        $typeParser = new TypeParser($parserConfig, $constExprParser);
        $this->phpDocParser = new PhpDocParser($parserConfig, $typeParser, $constExprParser);
    }
}
