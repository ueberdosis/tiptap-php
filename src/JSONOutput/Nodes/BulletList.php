<?php

namespace Tiptap\JSONOutput\Nodes;

class BulletList extends Node
{
    public function parseHTML()
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
