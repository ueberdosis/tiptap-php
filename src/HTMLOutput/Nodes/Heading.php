<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Heading extends Node
{
    public static $name = 'heading';

    public static function renderHTML($node)
    {
        return "h{$node->attrs->level}";
    }
}
