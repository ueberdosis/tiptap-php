<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public static function renderHTML($node)
    {
        return 'p';
    }
}
