<?php

namespace Tiptap\JSONOutput\Marks;

class Strike extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'strike'
            || $DOMNode->nodeName === 's'
            || $DOMNode->nodeName === 'del';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'strike',
        ];
    }
}
