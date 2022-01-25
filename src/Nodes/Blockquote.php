<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

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
        return ['blockquote'];
    }
}
