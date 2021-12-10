<?php

namespace Tiptap\Marks;

use Tiptap\Utils;
use Tiptap\Contracts\Mark;

class Italic extends Mark
{
    public static $name = 'italic';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'em',
            ],
            [
                'tag' => 'i',
                'getAttrs' => function ($DOMNode) {
                    return !Utils::hasInlineStyle($DOMNode, [
                        'font-style' => 'normal',
                    ]) ? null : false;
                }
            ],
            [
                // TODO: font-style=italic
                'style' => 'font-style',
                'getAttrs' => function ($value) {
                    return $value === 'italic' ? null : false;
                }
            ],
        ];
    }

    public static function renderHTML($mark)
    {
        return 'em';
    }
}
