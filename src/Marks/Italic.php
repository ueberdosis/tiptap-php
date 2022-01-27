<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\InlineStyle;
use Tiptap\Utils\HTML;

class Italic extends Mark
{
    public static $name = 'italic';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

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

    public function renderHTML($mark, $HTMLAttributes = [])
    {
        return ['em', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
