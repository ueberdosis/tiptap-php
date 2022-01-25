<?php

namespace Tiptap\Tests\Nodes\Custom;

use Tiptap\Core\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public function renderHTML($DOMNode)
    {
        return 'div';
    }
}
