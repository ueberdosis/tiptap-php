<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Blockquote extends Node
{
    public static $name = 'blockquote';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'blockquote'
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'blockquote';
    }
}
