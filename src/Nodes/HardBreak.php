<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class HardBreak extends Node
{
    public static $name = 'hardBreak';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'br',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['br', 0];
    }
}
