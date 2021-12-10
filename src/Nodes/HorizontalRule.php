<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HorizontalRule extends Node
{
    public static $name = 'horizontalRule';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'hr',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'hr';
    }
}
