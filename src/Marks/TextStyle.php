<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;

class TextStyle extends Mark
{
    public static $name = 'textStyle';

    public function parseHTML()
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

    public function renderHTML($mark)
    {
        return ['span', 0];
    }
}
