<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class BulletList extends Node
{
    public static $name = 'bulletList';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'ul',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['ul'];
    }
}
