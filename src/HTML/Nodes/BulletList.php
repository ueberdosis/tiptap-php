<?php

namespace Tiptap\HTML\Nodes;

class BulletList extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'ul';
    }

    public function data()
    {
        return [
            'type' => 'bullet_list',
        ];
    }
}
