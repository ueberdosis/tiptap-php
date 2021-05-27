<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class ListItem extends Node
{
    protected $name = 'list_item';

    public function renderHTML()
    {
        return 'li';
    }
}
