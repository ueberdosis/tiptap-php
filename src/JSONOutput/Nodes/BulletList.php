<?php

namespace Tiptap\JSONOutput\Nodes;

class BulletList extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'ul';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'bullet_list',
        ];
    }
}
