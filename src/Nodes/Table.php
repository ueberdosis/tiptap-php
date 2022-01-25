<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

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
        return ['table', ['tbody']];
    }
}
