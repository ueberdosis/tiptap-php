<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HorizontalRule extends Node
{
    public static $name = 'horizontal_rule';

    public static function renderHTML($node)
    {
        return 'hr';
    }

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
