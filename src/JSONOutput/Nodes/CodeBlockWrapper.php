<?php

namespace Tiptap\JSONOutput\Nodes;

class CodeBlockWrapper extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'pre';
    }

    public static function data($DOMNode)
    {
        return null;
    }
}
