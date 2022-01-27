<?php declare(strict_types=1);

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Superscript extends Mark
{
    public static $name = 'superscript';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'sup',
            ],
            [
                'style' => 'vertical-align',
                'getAttrs' => function ($value) {
                    return $value === 'super' ? null : false;
                },
            ],
        ];
    }

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return ['sup', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
