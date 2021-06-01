<?php

namespace Tiptap\JSONOutput\Marks;

class Italic extends Mark
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'em' || $DOMNode->nodeName === 'i';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'italic',
        ];
    }
}
