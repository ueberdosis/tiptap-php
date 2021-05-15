<?php

namespace Tiptap\HTML\Nodes;

class TableWrapper extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'table';
    }

    public function data()
    {
        return null;
    }
}
