<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HardBreak extends Node
{
    public static $name = 'hard_break';

    public static function renderHTML($node)
    {
        return 'br';
    }

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'br';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'hard_break',
        ];
    }
}
