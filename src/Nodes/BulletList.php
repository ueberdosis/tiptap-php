<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class BulletList extends Node
{
    public static $name = 'bulletList';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'ul',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        return ['ul', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
