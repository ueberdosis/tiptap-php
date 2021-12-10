<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class BulletList extends Node
{
    public static $name = 'bulletList';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'ul',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'ul';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'bulletList',
        ];
    }
}
