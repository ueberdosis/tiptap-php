<?php

namespace Tiptap\JSONOutput\Nodes;

class Node
{
    public static function wrapper($DOMNode)
    {
        return null;
    }

    public static $type;

    public static function parseHTML($DOMNode)
    {
        return false;
    }

    public static function data($DOMNode)
    {
        return [];
    }
}
