<?php

namespace Tiptap\Tests\Nodes\Custom;

use Tiptap\Contracts\Node;

class Div extends Node
{
    public static $name = 'div';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'div',
            ],
        ];
    }

    public static function renderHTML($DOMNode)
    {
        return 'div';
    }
}
