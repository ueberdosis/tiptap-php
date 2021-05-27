<?php

namespace Tiptap\HTMLOutput\Contracts;

class Node
{
    protected $node;

    protected $name;

    public function __construct($node)
    {
        $this->node = $node;
    }

    public function selfClosing()
    {
        return false;
    }

    public function renderHTML()
    {
        return null;
    }

    public function text()
    {
        return null;
    }
}
