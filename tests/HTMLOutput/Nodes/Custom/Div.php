<?php

namespace Tiptap\Tests\HTMLOutput\Nodes\Custom;

use Tiptap\HTMLOutput\Nodes\Node;

class Div extends Node
{
    public function matching()
    {
        return $this->node->type === 'div';
    }

    public function tag()
    {
        return 'div';
    }
}
