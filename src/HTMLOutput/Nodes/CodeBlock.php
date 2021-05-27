<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class CodeBlock extends Node
{
    public static $name = 'code_block';

    public static function renderHTML($node)
    {
        return ['pre', 'code'];
    }
}
