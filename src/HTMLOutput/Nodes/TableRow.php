<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class TableRow extends Node
{
    public static $name = 'table_row';

    public static function renderHTML($node)
    {
        return 'tr';
    }
}
