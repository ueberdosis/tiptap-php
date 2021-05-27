<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class HardBreak extends Node
{
    protected $name = 'hard_break';

    public function renderHTML()
    {
        return 'br';
    }
}
