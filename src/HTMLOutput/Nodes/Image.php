<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Image extends Node
{
    public $name = 'image';

    public function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }
}
