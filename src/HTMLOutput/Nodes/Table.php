<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Table extends Node
{
    protected $name = 'table';

    public function renderHTML()
    {
        return ['table', 'tbody'];
    }
}
