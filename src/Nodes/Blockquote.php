<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Blockquote extends Node
{
    public static $name = 'blockquote';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'blockquote',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['blockquote', 0];
    }
}
