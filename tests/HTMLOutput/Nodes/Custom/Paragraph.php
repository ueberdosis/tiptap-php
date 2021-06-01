<?php

namespace Tiptap\Tests\Nodes\Custom;

use Tiptap\HTMLOutput\Contracts\Node;

class Paragraph extends Node
{
    protected $nodeType = 'paragraph';
    public function renderHTML() {
return 'div';
}
