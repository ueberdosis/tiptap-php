<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\InlineStyle;

class Highlight extends Mark
{
    public static $name = 'highlight';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'mark',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'color' => [
                'parseHTML' => function ($DOMNode) {
                    if ($color = $DOMNode->getAttribute('data-color')) {
                        return $color;
                    }

                    return InlineStyle::getAttribute($DOMNode, 'background-color') ?: null;
                },
            ],
        ];
    }

    public function renderHTML($mark)
    {
        return ['mark'];
    }
}
