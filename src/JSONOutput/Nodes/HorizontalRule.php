<?php

namespace Tiptap\JSONOutput\Nodes;

class HorizontalRule extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'hr';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'horizontal_rule',
        ];
    }
}
