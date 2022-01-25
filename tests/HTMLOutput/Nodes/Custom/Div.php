<?php

namespace Tiptap\Tests\Nodes\Custom;

use Tiptap\Contracts\Node;

class Div extends Node
{
    public static $name = 'div';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'div',
            ],
        ];
    }

    public function renderHTML($DOMNode)
    {
        return 'div';
    }
}
