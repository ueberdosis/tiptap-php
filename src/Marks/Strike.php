<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Strike extends Mark
{
    public static $name = 'strike';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 's',
            ],
            [
                'tag' => 'del',
            ],
            [
                'tag' => 'strike',
            ],
            [
                'style' => 'text-decoration',
                'getAttrs' => function ($value) {
                    return $value === 'line-through' ? null : false;
                },
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return 'strike';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'strike',
        ];
    }
}
