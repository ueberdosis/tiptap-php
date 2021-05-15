<?php

namespace Tiptap\JSONOutput\Nodes;

class User extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'user-mention';
    }

    public function data()
    {
        return [
            'type' => 'user',
            'attrs' => [
                'id' => $this->DOMNode->getAttribute('data-id'),
            ],
        ];
    }
}
