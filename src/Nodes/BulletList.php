<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class BulletList extends Node
{
    public static $name = 'bulletList';

    public static function parseHTML()
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
}
