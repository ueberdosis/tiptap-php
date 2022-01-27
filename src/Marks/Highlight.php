<?php declare(strict_types=1);

namespace Tiptap\Marks;

use Tiptap\Core\Mark;
use Tiptap\Utils\HTML;
use Tiptap\Utils\InlineStyle;

class Highlight extends Mark
{
    public static $name = 'highlight';

    public function addOptions()
    {
        return [
            'multicolor' => false,
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'mark',
            ],
        ];
    }

    public function addAttributes()
    {
        if (! $this->options['multicolor']) {
            return [];
        }

        return [
            'color' => [
                'parseHTML' => function ($DOMNode) {
                    if ($color = $DOMNode->getAttribute('data-color')) {
                        return $color;
                    }

                    return InlineStyle::getAttribute($DOMNode, 'background-color') ?: null;
                },
                'renderHTML' => function ($attributes) {
                    if (! $attributes->color) {
                        return null;
                    }

                    return [
                        'data-color' => $attributes->color,
                        'style' => "background-color: {$attributes->color}",
                    ];
                },
            ],
        ];
    }

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return [
            'mark',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
