<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class TextStyle extends Mark
{
    public static $name = 'textStyle';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'span',
                'getAttrs' => function ($DOMNode) {
                    return $DOMNode->hasAttribute('style') ? null : false;
                },
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return ['span'];
    }
}
