<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class TextAlign extends Extension
{
    public static $name = 'textAlign';

    public function addOptions()
    {
        return [
            'types' => [],
            'alignments' => ['left', 'center', 'right', 'justify'],
            'defaultAlignment' => 'left',
        ];
    }

    public function addGlobalAttributes()
    {
        return [
            [
              'types' => $this->options['types'],
              'attributes' => [
                'textAlign' => [
                    'default' => $this->options['defaultAlignment'],
                    'parseHTML' => fn ($DOMNode) =>
                        InlineStyle::getAttribute($DOMNode, 'text-align') ?? $this->options['defaultAlignment'],
                    'renderHTML' => function ($attributes) {
                        $alignment = $attributes->textAlign ?? null;

                        if (
                            ! InlineStyle::isValidCSSStyleValue($alignment)
                            || $alignment === $this->options['defaultAlignment']
                        ) {
                            return null;
                        }

                        return ['style' => "text-align: {$alignment}"];
                    },
                ],
              ],
            ],
        ];
    }
}
