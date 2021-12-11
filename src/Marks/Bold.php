<?php

namespace Tiptap\Marks;

use Tiptap\Utils\InlineStyle;
use Tiptap\Contracts\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'strong',
            ],
            [
                'tag' => 'b',
                'getAttrs' => function ($DOMNode) {
                    return !InlineStyle::hasAttribute($DOMNode, [
                        'font-weight' => 'normal',
                    ]) ? null : false;
                }
            ],
            [
                'style' => 'font-weight',
                'getAttrs' => function ($value) {
                    return (bool) preg_match('/^(bold(er)?|[5-9]\d{2,})$/', $value) ? null : false;
                }
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return ['strong'];
    }
}
