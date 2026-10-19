<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Table extends Node
{
    public static $name = 'table';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
            'cellMinWidth' => 25,
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'table',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        if (! isset($node->content[0])) {
            return [
                'table',
                HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
                ['tbody', 0],
            ];
        }

        $columns = [];
        $totalWidth = 0;
        $fixedWidth = true;
        $cellMinWidth = (float) $this->options['cellMinWidth'];

        foreach ($node->content[0]->content ?? [] as $cell) {
            $colspan = $cell->attrs->colspan ?? 1;
            $colspan = is_scalar($colspan) ? max(1, min(1000, (int) $colspan)) : 1;

            for ($columnIndex = 0; $columnIndex < $colspan; $columnIndex++) {
                $columnWidth = (float) ($cell->attrs->colwidth[$columnIndex] ?? 0);
                $totalWidth += $columnWidth ?: $cellMinWidth;

                if (! $columnWidth) {
                    $fixedWidth = false;
                }

                $columnStyle = $columnWidth
                    ? 'width: ' . max($columnWidth, $cellMinWidth) . 'px'
                    : "min-width: {$cellMinWidth}px";

                $columns[] = ['col', ['style' => $columnStyle]];
            }
        }

        if (empty($HTMLAttributes['style'])) {
            $HTMLAttributes['style'] = $fixedWidth
                ? "width: {$totalWidth}px"
                : "min-width: {$totalWidth}px";
        }

        return [
            'table',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            ['colgroup', [], ...$columns],
            ['tbody', 0],
        ];
    }
}
