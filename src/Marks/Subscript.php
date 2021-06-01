<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Subscript extends Mark
{
    public static $name = 'subscript';

    public static function renderHTML($mark)
    {
        return 'sub';
    }

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
