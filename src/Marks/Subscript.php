<?php declare(strict_types=1);

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Subscript extends Mark
{
    public static string $name = 'subscript';

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

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return ['sub', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
