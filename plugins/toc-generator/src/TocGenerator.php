<?php

namespace Formwork\Plugins\TocGenerator;

use Masterminds\HTML5;


class TocGenerator
{
    private HTML5 $html5;

    public function __construct()
    {
        $this->html5 = new HTML5();
    }

    /**
     * Generates a Table of Contents (ToC) from the provided HTML content.
     * @param ?list<int> $levels
     * @return array<mixed>
     */
    public function generateToc(string $htmlContent, ?array $levels = null)
    {
        $dom = $this->html5->loadHTML($htmlContent);

        $levels ??= [1, 2, 3, 4, 5, 6];

        $headings = [];


        // Find all headings (h1, h2, h3, etc.)
        foreach ($dom->getElementsByTagName('*') as $element) {
            if (preg_match('/^h[1-6]$/', $element->nodeName)) {
                $level = (int)substr($element->nodeName, 1);

                if (!in_array($level, $levels, true)) {
                    continue; // Skip headings not in the specified levels
                }

                $headings[] = [
                    'level' => $level,
                    'text'  => $element->textContent,
                    'id'    => $element->getAttribute('id'),
                    'class' => $element->getAttribute('class'),
                ];
            }
        }

        return $this->buildNestedToc($headings);
    }

    /**
     *
     * @param array{level: int, text: string, id: string}[] $headings
     * @return array<mixed>
     */
    private function buildNestedToc($headings)
    {
        if (empty($headings)) {
            return [];
        }

        $result = [];
        $i = 0;

        while ($i < count($headings)) {
            $current = $headings[$i];
            $item = [
                'level' => $current['level'],
                'text' => $current['text'],
                'id' => $current['id'],
                'class' => $current['class'],
                'children' => []
            ];

            // Find children for this heading
            $j = $i + 1;
            $children = [];

            while ($j < count($headings) && $headings[$j]['level'] > $current['level']) {
                $children[] = $headings[$j];
                $j++;
            }

            // Recursively build children if any exist
            if (!empty($children)) {
                $item['children'] = $this->buildNestedToc($children);
            }

            $result[] = $item;
            $i = $j; // Skip processed children
        }

        return $result;
    }
}
