<?php

namespace Tiptap\JSONOutput\Marks;

class Subscript extends Mark
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'sub';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'subscript',
        ];
    }
}
