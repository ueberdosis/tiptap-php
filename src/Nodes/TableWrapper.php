<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class TableWrapper extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'table';
    }

    public static function data($DOMNode)
    {
        return null;
    }
}
