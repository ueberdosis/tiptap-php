<?php

namespace Tiptap\JSONOutput\Nodes;

class Table extends Node
{
    public function parseHTML()
    {
        return
        $this->DOMNode->nodeName === 'tbody' &&
        $this->DOMNode->parentNode->nodeName === 'table';
    }

    public function data()
    {
        return [
            'type' => 'table',
        ];
    }
}
