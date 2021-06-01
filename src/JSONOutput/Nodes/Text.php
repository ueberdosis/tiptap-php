<?php

namespace Tiptap\JSONOutput\Nodes;

class Text extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === '#text';
    }

    public function data($DOMNode)
    {
        $text = ltrim($DOMNode->nodeValue, "\n");

        if ($text === '') {
            return null;
        }

        return [
            'type' => 'text',
            'text' => $text,
        ];
    }
}
