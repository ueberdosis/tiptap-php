<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class ListItem extends Node
{
    public static $name = 'listItem';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'li',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'li';
    }

    public static function wrapper($DOMNode)
    {
        if (
            $DOMNode->childNodes->length === 1
            && $DOMNode->childNodes[0]->nodeName == "p"
        ) {
            return null;
        }

        return [
            'type' => 'paragraph',
        ];
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'listItem',
        ];
    }
}
