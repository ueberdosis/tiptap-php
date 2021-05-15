<?php

namespace Tiptap\Nodes;

class HardBreak extends Node
{
    protected $name = 'hard_break';
    protected $tagName = 'br';

    public function selfClosing()
    {
        return true;
    }
}
