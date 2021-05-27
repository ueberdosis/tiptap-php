<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class HorizontalRule extends Node
{
    public static $name = 'horizontal_rule';

    public static function renderHTML($node)
    {
        return 'hr';
    }
}
