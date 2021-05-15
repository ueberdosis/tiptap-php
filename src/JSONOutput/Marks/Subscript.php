<?php

namespace Tiptap\JSONOutput\Marks;

class Subscript extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'sub';
    }

    public function data()
    {
        return [
            'type' => 'subscript',
        ];
    }
}
