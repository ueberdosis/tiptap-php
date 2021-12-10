<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class HardBreak extends Node
{
    public static $name = 'hardBreak';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'br',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return ['br'];
    }
}
