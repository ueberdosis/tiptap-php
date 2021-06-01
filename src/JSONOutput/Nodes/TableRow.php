<?php

namespace Tiptap\JSONOutput\Nodes;

class TableRow extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'tr';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'table_row',
        ];
    }
}
