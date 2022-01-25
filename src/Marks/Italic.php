<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\InlineStyle;

class Italic extends Mark
{
    public static $name = 'italic';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'em',
            ],
            [
                'tag' => 'i',
                'getAttrs' => function ($DOMNode) {
                    return ! InlineStyle::hasAttribute($DOMNode, [
                        'font-style' => 'normal',
                    ]) ? null : false;
                },
            ],
            [
                // TODO: font-style=italic
                'style' => 'font-style',
                'getAttrs' => function ($value) {
                    return $value === 'italic' ? null : false;
                },
            ],
        ];
    }

    public function renderHTML($mark)
    {
        return ['em'];
    }
}
