<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public static function renderHTML($node)
    {
        return 'p';
    }

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
