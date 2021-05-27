<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Table extends Node
{
    public $name = 'table';

    public function renderHTML()
    {
        return ['table', 'tbody'];
    }
}
