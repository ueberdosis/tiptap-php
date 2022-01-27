<?php declare(strict_types=1);

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class Italic extends Mark
{
    public static $name = 'italic';

    public function parseHTML(): array
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

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return ['em', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
