<?php

namespace Tiptap\JSONOutput\Nodes;

class Blockquote extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'blockquote';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'blockquote',
        ];
    }
}
