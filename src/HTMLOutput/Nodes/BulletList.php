<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class BulletList extends Node
{
    public $name = 'bullet_list';

    public function renderHTML()
    {
        return 'ul';
    }
}
