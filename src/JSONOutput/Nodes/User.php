<?php

namespace Tiptap\JSONOutput\Nodes;

class User extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'user-mention';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'user',
            'attrs' => [
                'id' => $DOMNode->getAttribute('data-id'),
            ],
        ];
    }
}
