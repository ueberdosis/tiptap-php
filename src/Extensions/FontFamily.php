<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class FontFamily extends Extension
{
    public static $name = 'fontFamily';

    public function addOptions()
    {
        return [
            'types' => ['textStyle'],
        ];
    }

    public function addGlobalAttributes()
    {
        return [
            [
                'types' => $this->options['types'],
                'attributes' => [
                    'fontFamily' => [
                        'default' => null,
                        'parseHTML' => function ($DOMNode) {
                            $attribute = InlineStyle::getAttribute($DOMNode, 'font-family');

                            if ($attribute === null) {
                                return null;
                            }

                            return $attribute;
                        },
                        'renderHTML' => function ($attributes) {
                            $fontFamily = $attributes?->fontFamily ?? null;

                            if ($fontFamily === null) {
                                return null;
                            }

                            return ['style' => "font-family: {$fontFamily}"];
                        },
                    ],
                ],
            ],
        ];
    }
}
