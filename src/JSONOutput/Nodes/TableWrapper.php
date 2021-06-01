<?php

namespace Tiptap\JSONOutput\Nodes;

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
