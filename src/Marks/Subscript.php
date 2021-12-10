<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Subscript extends Mark
{
    public static $name = 'subscript';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'sub',
            ],
            [
                'style' => 'vertical-align',
                'getAttrs' => function ($value) {
                    return $value === 'sub' ? null : false;
                },
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return 'sub';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'subscript',
        ];
    }
}
