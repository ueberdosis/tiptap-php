<?php

namespace Tiptap\JSONOutput\Nodes;

class HardBreak extends Node
{
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
