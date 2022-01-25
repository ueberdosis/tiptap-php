<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class TableRow extends Node
{
    public static $name = 'tableRow';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'tr',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['tr', 0];
    }
}
