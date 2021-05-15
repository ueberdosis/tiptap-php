<?php

namespace Tiptap\HTML\Nodes;

class HorizontalRule extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'hr';
    }

    public function data()
    {
        return [
            'type' => 'horizontal_rule',
        ];
    }
}
