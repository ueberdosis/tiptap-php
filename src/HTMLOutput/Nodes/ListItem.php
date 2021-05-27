<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class ListItem extends Node
{
    public static $name = 'list_item';

    public static function renderHTML($node)
    {
        return 'li';
    }
}
