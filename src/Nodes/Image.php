<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Image extends Node
{
    public static $name = 'image';

    public function parseHTML()
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

    public function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }
}
