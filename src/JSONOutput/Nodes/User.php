<?php

namespace Tiptap\JSONOutput\Nodes;

class User extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'user-mention';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'user',
            'attrs' => [
                'id' => $DOMNode->getAttribute('data-id'),
            ],
        ];
    }
}
