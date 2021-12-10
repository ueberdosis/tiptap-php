<?php

namespace Tiptap\Marks;

use Tiptap\Utils;
use Tiptap\Contracts\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'strong',
            ],
            [
                'tag' => 'b',
                'getAttrs' => function ($DOMNode) {
                    return !Utils::hasInlineStyle($DOMNode, [
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

    public static function data($DOMNode)
    {
        return [
            'type' => 'bold',
        ];
    }
}
