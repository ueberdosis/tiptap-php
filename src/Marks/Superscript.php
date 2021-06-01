<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Superscript extends Mark
{
    public static $name = 'superscript';

    public static function renderHTML($mark)
    {
        return 'sup';
    }

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
