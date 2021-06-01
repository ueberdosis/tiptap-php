<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Underline extends Mark
{
    public static $name = 'underline';

    public static function renderHTML($mark)
    {
        return 'u';
    }

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
