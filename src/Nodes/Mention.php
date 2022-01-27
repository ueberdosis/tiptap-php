<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Mention extends Node
{
    public static $name = 'mention';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'span[data-type="' . self::$name . '"]',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'id' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->getAttribute('data-id') ?: null,
            ],
        ];
    }

    // TODO: Render HTML
}
