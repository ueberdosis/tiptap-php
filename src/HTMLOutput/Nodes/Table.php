<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Table extends Node
{
    public static $name = 'table';

    public static function renderHTML($node)
    {
        return ['table', 'tbody'];
    }
}
