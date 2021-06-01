<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Strike extends Mark
{
    public static $name = 'strike';

    public static function renderHTML($mark)
    {
        return 'strike';
    }

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
