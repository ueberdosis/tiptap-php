<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Paragraph extends Node
{
    protected $name = 'paragraph';
    public function renderHTML()
    {
        return 'p';
    }
}
