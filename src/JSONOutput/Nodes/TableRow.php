<?php

namespace Tiptap\JSONOutput\Nodes;

class TableRow extends Node
{
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
