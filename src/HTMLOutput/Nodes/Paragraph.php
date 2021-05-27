<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class Paragraph extends Node
{
    public $name = 'paragraph';

    public function renderHTML($node)
    {
        return 'p';
    }
}
