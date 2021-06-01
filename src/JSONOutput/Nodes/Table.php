<?php

namespace Tiptap\JSONOutput\Nodes;

class Table extends Node
{
    public function parseHTML($DOMNode)
    {
        return
        $DOMNode->nodeName === 'tbody' &&
        $DOMNode->parentNode->nodeName === 'table';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'table',
        ];
    }
}
