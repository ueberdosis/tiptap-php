<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class TableRow extends Node
{
    public static $name = 'tableRow';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'tr',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'tr';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'tableRow',
        ];
    }
}
