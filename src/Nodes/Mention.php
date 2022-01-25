<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Mention extends Node
{
    public static $name = 'mention';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'span[data-type="' . self::$name . '"]',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'id' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->getAttribute('data-id') ?: null,
            ],
        ];
    }

    // TODO: Render HTML
}
