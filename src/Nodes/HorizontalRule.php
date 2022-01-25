<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HorizontalRule extends Node
{
    public static $name = 'horizontalRule';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'hr',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['hr'];
    }
}
