<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Underline extends Mark
{
    public static $name = 'underline';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'u',
            ],
            [
                'style' => 'text-decoration',
                'getAttrs' => function ($value) {
                    return $value === 'underline' ? null : false;
                },
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = []): array
    {
        return ['u', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
