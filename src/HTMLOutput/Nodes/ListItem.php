<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class ListItem extends Node
{
    public $name = 'list_item';

    public function renderHTML()
    {
        return 'li';
    }
}
