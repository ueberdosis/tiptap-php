<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Text extends Node
{
    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => '#text',
            ],
        ];
    }

    public static function data($DOMNode)
    {
        $text = ltrim($DOMNode->nodeValue, "\n");

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'text',
            'text' => $text,
        ];
    }
}
