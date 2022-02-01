<?php declare(strict_types=1);

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;

class Strike extends Mark
{
    public static string $name = 'strike';

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 's',
            ],
            [
                'tag' => 'del',
            ],
            [
                'tag' => 'strike',
            ],
            [
                'style' => 'text-decoration',
                'getAttrs' => function ($value) {
                    return $value === 'line-through' ? null : false;
                },
            ],
        ];
    }

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return ['strike', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
