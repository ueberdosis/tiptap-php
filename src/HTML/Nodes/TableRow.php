<?php

namespace Tiptap\HTML\Nodes;

class TableRow extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'tr';
    }

    public function data()
    {
        return [
            'type' => 'table_row',
        ];
    }
}
