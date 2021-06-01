<?php

namespace Tiptap\JSONOutput\Marks;

class Strike extends Mark
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'strike'
            || $DOMNode->nodeName === 's'
            || $DOMNode->nodeName === 'del';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'strike',
        ];
    }
}
