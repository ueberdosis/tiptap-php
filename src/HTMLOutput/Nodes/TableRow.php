<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class TableRow extends Node
{
    protected $name = 'table_row';

    public function renderHTML()
    {
        return 'tr';
    }
}
