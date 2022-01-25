<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;

class Subscript extends Mark
{
    public static $name = 'subscript';

    public function parseHTML()
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

    public function renderHTML($mark)
    {
        return ['sub'];
    }
}
