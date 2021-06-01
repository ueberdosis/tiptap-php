<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Mention extends Node
{
    // TODO: renderHTML?

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
