<?php

namespace Tiptap\HTML\Marks;

class Code extends Mark
{
    public function parseHTML()
    {
        if ($this->DOMNode->parentNode->nodeName === 'pre') {
            return false;
        }

        return $this->DOMNode->nodeName === 'code';
    }

    public function data()
    {
        return [
            'type' => 'code',
        ];
    }
}
