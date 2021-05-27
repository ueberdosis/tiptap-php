<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Image extends Node
{
    public $name = 'image';

    public function renderHTML()
    {
        return [
            'tag' => 'img',
            'attrs' => $this->node->attrs,
        ];
    }
}
