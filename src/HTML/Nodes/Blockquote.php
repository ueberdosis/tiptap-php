<?php

namespace Tiptap\HTML\Nodes;

class Blockquote extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'blockquote';
    }

    public function data()
    {
        return [
            'type' => 'blockquote',
        ];
    }
}
