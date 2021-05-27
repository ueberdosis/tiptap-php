<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Heading extends Node
{
    public $name = 'heading';

    public function renderHTML($node)
    {
        return "h{$node->attrs->level}";
    }
}
