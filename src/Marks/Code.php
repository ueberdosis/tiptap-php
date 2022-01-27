<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Code extends Mark
{
    public static $name = 'code';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'code',
            ],
        ];
    }

    public function renderHTML($mark, $HTMLAttributes = []): array
    {
        return ['code', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
