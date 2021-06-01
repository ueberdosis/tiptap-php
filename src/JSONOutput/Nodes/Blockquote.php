<?php

namespace Tiptap\JSONOutput\Nodes;

class Blockquote extends Node
{
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
