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
        return [
            [
                'tag' => 'sup',
            ],
            [
                'style' => 'vertical-align',
                'getAttrs' => function ($value) {
                    return $value === 'super' ? null : false;
                },
            ],
        ];
    }
}
