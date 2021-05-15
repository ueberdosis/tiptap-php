<?php

namespace Tiptap\JSONOutput\Nodes;

class HardBreak extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'br';
    }

    public function data()
    {
        return [
            'type' => 'hard_break',
        ];
    }
}
