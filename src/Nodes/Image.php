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
            'src' => [],
            'alt' => [],
            'title' => [],
        ];
    }

    public function renderHTML($node)
    {
        return ['img', (array) $node->attrs, 0];
    }
}
