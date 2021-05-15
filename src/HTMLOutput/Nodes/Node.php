<?php

namespace Tiptap\HTMLOutput\Nodes;

class Node
{
    protected $node;
    protected $name;
    protected $tagName = null;

    public function __construct($node)
    {
        $this->node = $node;
    }

    public function matching()
    {
        if (isset($this->node->type)) {
            return $this->node->type === $this->name;
        }

        return false;
    }

    public function selfClosing()
    {
        return false;
    }

    public function tag()
    {
        return $this->tagName;
    }

    public function text()
    {
        return null;
    }
}
