<?php

namespace Tiptap\JSONOutput\Nodes;

class Paragraph extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'p';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'paragraph',
        ];
    }
}
