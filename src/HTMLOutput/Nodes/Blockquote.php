<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Blockquote extends Node
{
    public static $name = 'blockquote';

    public static function renderHTML($node)
    {
        return 'blockquote';
    }
}
