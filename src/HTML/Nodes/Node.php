<?php

namespace Tiptap\HTML\Nodes;

class Node
{
    public $wrapper = null;

    public $type = 'node';

    protected $DOMNode;

    public function __construct($DOMNode)
    {
        $this->DOMNode = $DOMNode;
    }

    public function parseHTML()
    {
        return false;
    }

    public function data()
    {
        return [];
    }
}
