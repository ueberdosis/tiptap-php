<?php

namespace Tiptap\JSONOutput\Nodes;

class Table extends Node
{
    public static function parseHTML($DOMNode)
    {
        return
        $DOMNode->nodeName === 'tbody' &&
        $DOMNode->parentNode->nodeName === 'table';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'table',
        ];
    }
}
