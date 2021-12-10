<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Table extends Node
{
    public static $name = 'table';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'table',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return ['table', 'tbody'];
    }
}
