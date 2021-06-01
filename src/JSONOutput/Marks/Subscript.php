<?php

namespace Tiptap\JSONOutput\Marks;

class Subscript extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'sub';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'subscript',
        ];
    }
}
