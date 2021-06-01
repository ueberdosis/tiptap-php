<?php

namespace Tiptap\JSONOutput\Nodes;

class HardBreak extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'br';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'hard_break',
        ];
    }
}
