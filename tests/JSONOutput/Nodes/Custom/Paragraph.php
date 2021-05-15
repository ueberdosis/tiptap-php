<?php

namespace Tiptap\Tests\JSONOutput\Nodes\Custom;

use Tiptap\JSONOutput\Nodes\Node;

class Paragraph extends Node
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'div';
    }

    public function data()
    {
        return [
            'type' => 'paragraph',
        ];
    }
}
