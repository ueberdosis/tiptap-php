<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class DetailsContent extends Node
{
    public static $name = 'detailsContent';

    public function addOptions(): array
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'div[data-type]',
                'getAttrs' => fn ($value): bool => (bool) $value == 'detailsContent',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): array
    {
        return [
            'div',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes, ['data-type' => 'detailsContent']),
            0,
        ];
    }
}
