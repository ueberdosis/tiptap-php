<?php

namespace Tiptap\JSONOutput\Marks;

class Italic extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'em' || $DOMNode->nodeName === 'i';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'italic',
        ];
    }
}
