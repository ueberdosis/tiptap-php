<?php

namespace Tiptap\HTML\Nodes;

class Paragraph extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'p';
    }

    public function data()
    {
        return [
            'type' => 'paragraph',
        ];
    }
}
