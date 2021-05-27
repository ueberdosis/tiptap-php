<?php

namespace Tiptap\Tests\HTMLOutput\Nodes\Custom;

use Tiptap\HTMLOutput\Contracts\Node;

class Paragraph extends Node
{
    protected $nodeType = 'paragraph';
    public function renderHTML() {
return 'div';
}
