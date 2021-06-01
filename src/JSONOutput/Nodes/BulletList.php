<?php

namespace Tiptap\JSONOutput\Nodes;

class BulletList extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'ul';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'bullet_list',
        ];
    }
}
