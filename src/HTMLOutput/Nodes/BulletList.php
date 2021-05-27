<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class BulletList extends Node
{
    public static $name = 'bullet_list';

    public static function renderHTML($node)
    {
        return 'ul';
    }
}
