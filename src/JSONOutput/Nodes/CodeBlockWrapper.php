<?php

namespace Tiptap\JSONOutput\Nodes;

class CodeBlockWrapper extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'pre';
    }

    public function data($DOMNode)
    {
        return null;
    }
}
