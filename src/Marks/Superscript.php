<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Superscript extends Mark
{
    public static $name = 'superscript';

    public function parseHTML()
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

    public function renderHTML($mark)
    {
        return ['sup'];
    }
}
