<?php

namespace Tiptap\JSONOutput\Marks;

class Code extends Mark
{
    public static function parseHTML($DOMNode)
    {
        if ($DOMNode->parentNode->nodeName === 'pre') {
            return false;
        }

        return $DOMNode->nodeName === 'code';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'code',
        ];
    }
}
