<?php

namespace Tiptap\HTML\Marks;

class Superscript extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'sup';
    }

    public function data()
    {
        return [
            'type' => 'superscript',
        ];
    }
}
