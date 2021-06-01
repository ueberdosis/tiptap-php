<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class TableRow extends Node
{
    public static $name = 'table_row';

    public static function renderHTML($node)
    {
        return 'tr';
    }

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'tr';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'table_row',
        ];
    }
}
