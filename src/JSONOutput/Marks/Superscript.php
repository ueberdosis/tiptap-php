<?php

namespace Tiptap\JSONOutput\Marks;

class Superscript extends Mark
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'sup';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'superscript',
        ];
    }
}
