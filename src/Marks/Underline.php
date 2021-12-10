<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Underline extends Mark
{
    public static $name = 'underline';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'u',
            ],
            [
                'style' => 'text-decoration',
                'getAttrs' => function ($value) {
                    return $value === 'underline' ? null : false;
                },
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return 'u';
    }
}
