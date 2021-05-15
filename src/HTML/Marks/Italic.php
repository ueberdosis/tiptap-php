<?php

namespace Tiptap\HTML\Marks;

class Italic extends Mark
{
    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'em' || $this->DOMNode->nodeName === 'i';
    }

    public function data()
    {
        return [
            'type' => 'italic',
        ];
    }
}
