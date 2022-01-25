<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class ListItem extends Node
{
    public static $name = 'listItem';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'li',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['li'];
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
}
