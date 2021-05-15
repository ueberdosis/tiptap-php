<?php

namespace Tiptap\Tests\HTMLOutput\Nodes\Custom;

use Tiptap\HTMLOutput\Nodes\Node;

class Paragraph extends Node
{
    protected $nodeType = 'paragraph';
    protected $tagName = 'div';
}
