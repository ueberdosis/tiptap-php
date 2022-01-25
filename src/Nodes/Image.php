<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Image extends Node
{
    public static $name = 'image';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'img[src]',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'alt' => [],
            'title' => [],
            'src' => [],
        ];
    }

    public static function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }
}
