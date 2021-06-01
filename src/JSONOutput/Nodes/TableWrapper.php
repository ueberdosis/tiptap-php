<?php

namespace Tiptap\JSONOutput\Nodes;

class TableWrapper extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'table';
    }

    public function data($DOMNode)
    {
        return null;
    }
}
