<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class TextStyle extends Mark
{
    public static $name = 'textStyle';

    public function parseHTML(): array
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

    public function renderHTML($mark, $HTMLAttributes = []): array
    {
        return ['span', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
