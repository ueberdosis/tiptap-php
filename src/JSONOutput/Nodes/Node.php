<?php

namespace Tiptap\JSONOutput\Nodes;

class Node
{
    public $wrapper = null;

    public $type = 'node';

    public function parseHTML($DOMNode)
    {
        return false;
    }

    public function data($DOMNode)
    {
        return [];
    }
}
