<?php

namespace Tiptap\JSONOutput\Marks;

class Superscript extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'sup';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'superscript',
        ];
    }
}
