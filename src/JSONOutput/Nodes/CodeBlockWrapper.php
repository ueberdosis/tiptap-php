<?php

namespace Tiptap\JSONOutput\Nodes;

class CodeBlockWrapper extends Node
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'pre';
    }

    public function data()
    {
        return null;
    }
}
