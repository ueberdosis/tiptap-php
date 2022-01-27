<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class HardBreak extends Node
{
    public static $name = 'hardBreak';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'br',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['br', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes)];
    }
}
