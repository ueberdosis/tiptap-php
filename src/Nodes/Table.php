<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Table extends Node
{
    public static $name = 'table';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'table',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['table', 'tbody'];
    }
}
