<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class CodeBlock extends Node
{
    protected $name = 'code_block';

    public function renderHTML()
    {
        return ['pre', 'code'];
    }
}
