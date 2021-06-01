<?php

namespace Tiptap\JSONOutput\Marks;

class Underline extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'u';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'underline',
        ];
    }
}
