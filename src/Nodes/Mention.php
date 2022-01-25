<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Mention extends Node
{
    public static $name = 'mention';

    public static function parseHTML()
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
}
