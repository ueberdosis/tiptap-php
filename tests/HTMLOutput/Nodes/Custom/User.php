<?php

namespace Tiptap\Tests\HTMLOutput\Nodes\Custom;

use Tiptap\HTMLOutput\Nodes\Node;

class User extends Node
{
    public function matching()
    {
        return $this->node->type === 'user';
    }

    public function text()
    {
        return 'Foobar';
    }
}
