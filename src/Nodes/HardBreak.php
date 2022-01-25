<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

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
        return ['br'];
    }
}
