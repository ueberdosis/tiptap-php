<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Image extends Node
{
    public static $name = 'image';

    public static function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }
}
