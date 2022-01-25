<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;

class Underline extends Mark
{
    public static $name = 'underline';

    public function parseHTML()
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

    public function renderHTML($mark)
    {
        return ['u', 0];
    }
}
