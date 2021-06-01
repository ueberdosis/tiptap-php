<?php

namespace Tiptap\JSONOutput\Nodes;

class ListItem extends Node
{
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

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'li';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'list_item',
        ];
    }
}
