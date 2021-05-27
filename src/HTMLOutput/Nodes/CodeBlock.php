<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class CodeBlock extends Node
{
    public $name = 'code_block';

    public function renderHTML()
    {
        return ['pre', 'code'];
    }
}
