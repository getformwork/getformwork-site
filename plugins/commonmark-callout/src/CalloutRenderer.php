<?php

namespace Formwork\Plugins\CommonMarkCallout;

use Closure;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;

final class CalloutRenderer implements NodeRendererInterface
{
    private Closure $renderIcon;

    public function __construct(Closure $renderIcon)
    {
        $this->renderIcon = $renderIcon;
    }

    /**
     * @param Callout $node
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Callout::assertInstanceOf($node);

        $type = strtolower($node->type);
        $title = $node->title ?? ucfirst($type);
        $content = $childRenderer->renderNodes($node->children());

        $titleHtml = new HtmlElement(
            'div',
            ['class' => 'callout-title'],
            [
                ($this->renderIcon)($type),
                new HtmlElement('strong', ['class' => 'callout-title-inner'], $title, false)
            ],
            false
        );

        $contentHtml = new HtmlElement(
            'div',
            ['class' => 'callout-content'],
            $content
        );

        return new HtmlElement(
            'blockquote',
            ['class' => "callout callout-{$type}"],
            [$titleHtml, $contentHtml]
        );
    }
}
