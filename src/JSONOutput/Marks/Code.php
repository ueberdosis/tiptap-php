<?php

namespace Tiptap\JSONOutput\Marks;

class Code extends Mark
{
    public function parseHTML($DOMNode)
    {
        if ($DOMNode->parentNode->nodeName === 'pre') {
            return false;
        }

        return $DOMNode->nodeName === 'code';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'code',
        ];
    }
}
