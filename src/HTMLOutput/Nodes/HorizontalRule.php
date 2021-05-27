<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class HorizontalRule extends Node
{
    public $name = 'horizontal_rule';

    public function renderHTML()
    {
        return 'hr';
    }
}
