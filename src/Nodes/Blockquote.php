<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Blockquote extends Node
{
    public static $name = 'blockquote';

    public static function renderHTML($node)
    {
        return 'blockquote';
    }

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'blockquote';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'blockquote',
        ];
    }
}
