<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Table extends Node
{
    public static $name = 'table';

    public static function parseHTML($DOMNode)
    {
        return
            $DOMNode->nodeName === 'tbody' &&
            $DOMNode->parentNode->nodeName === 'table';
    }

    public static function renderHTML($node)
    {
        return ['table', 'tbody'];
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'table',
        ];
    }
}
