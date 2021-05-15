<?php

namespace Tiptap\HTMLOutput\Nodes;

class CodeBlock extends Node
{
    protected $name = 'code_block';
    protected $tagName = ['pre', 'code'];
}
