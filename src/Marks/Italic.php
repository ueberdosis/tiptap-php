<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Italic extends Mark
{
    public static $name = 'italic';

    public static function renderHTML($mark)
    {
        return 'em';
    }

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
