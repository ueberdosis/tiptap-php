<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class HardBreak extends Node
{
    public static $name = 'hard_break';

    public static function renderHTML($node)
    {
        return 'br';
    }
}
