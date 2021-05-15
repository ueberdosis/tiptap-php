<?php

namespace Tiptap\JSONOutput\Marks;

class Underline extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'u';
    }

    public function data()
    {
        return [
            'type' => 'underline',
        ];
    }
}
