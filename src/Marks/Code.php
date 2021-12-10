<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Code extends Mark
{
    public static $name = 'code';

    public static function parseHTML($DOMNode)
    {
        if ($DOMNode->parentNode->nodeName === 'pre') {
            return false;
        }

        return $DOMNode->nodeName === 'code';
    }

    public static function renderHTML($mark)
    {
        return 'code';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'code',
        ];
    }
}
