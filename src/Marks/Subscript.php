<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Subscript extends Mark
{
    public static $name = 'subscript';

    public function parseHTML(): array
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

    public function renderHTML($mark, $HTMLAttributes = []): array
    {
        return ['sub', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
