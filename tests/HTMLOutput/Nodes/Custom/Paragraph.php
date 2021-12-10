<?php

namespace Tiptap\Tests\Nodes\Custom;

use Tiptap\Contracts\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public static function renderHTML($DOMNode)
    {
        return 'div';
    }
}
