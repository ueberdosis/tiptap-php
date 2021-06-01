<?php

namespace Tiptap\JSONOutput\Nodes;

class HorizontalRule extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'hr';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'horizontal_rule',
        ];
    }
}
