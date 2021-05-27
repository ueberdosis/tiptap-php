<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Heading extends Node
{
    protected $name = 'heading';

    public function renderHTML()
    {
        return "h{$this->node->attrs->level}";
    }
}
