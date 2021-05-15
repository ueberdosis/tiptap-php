<?php

namespace Tiptap\HTML\Marks;

class Strike extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'strike'
            || $this->DOMNode->nodeName === 's'
            || $this->DOMNode->nodeName === 'del';
    }

    public function data()
    {
        return [
            'type' => 'strike',
        ];
    }
}
