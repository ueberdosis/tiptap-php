<?php

namespace Tiptap\JSONOutput\Nodes;

class Paragraph extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'p';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'paragraph',
        ];
    }
}
