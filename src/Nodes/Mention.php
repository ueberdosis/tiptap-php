<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Mention extends Node
{
    public static $name = 'mention';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'span[data-type="' . self::$name . '"]',
                'getAttrs' => function ($DOMNode) {
                    return [
                        'id' => $DOMNode->getAttribute('data-id'),
                    ];
                },
            ],
        ];
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'mention',
        ];
    }
}
