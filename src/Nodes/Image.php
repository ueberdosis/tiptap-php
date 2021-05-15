<?php

namespace Tiptap\Nodes;

class Image extends Node
{
    protected $name = 'image';
    protected $tagName = 'img';

    public function selfClosing()
    {
        return true;
    }

    public function tag()
    {
        return [
            [
                'tag' => $this->tagName,
                'attrs' => $this->node->attrs,
            ],
        ];
    }
}
