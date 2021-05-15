<?php

namespace Tiptap\HTML\Nodes;

class Text extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === '#text';
    }

    public function data()
    {
        $text = ltrim($this->DOMNode->nodeValue, "\n");

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'text',
            'text' => $text,
        ];
    }
}
