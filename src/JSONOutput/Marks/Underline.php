<?php

namespace Tiptap\JSONOutput\Marks;

class Underline extends Mark
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'u';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'underline',
        ];
    }
}
