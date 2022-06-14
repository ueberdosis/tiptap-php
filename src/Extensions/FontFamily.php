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
            'types' => [
                'textStyle'
            ],
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
                        'parseHTML' => static function ($DOMNode) {
                            $attribute = InlineStyle::getAttribute($DOMNode, 'font-family');

                            if ($attribute === null) {
                                return null;
                            }

                            return preg_replace('/[\'"]+/', '', $attribute);
                        },
                        'renderHTML' => static function ($attributes) {
                            if ($attributes?->fontFamily === null) {
                                return null;
                            }

                            return ['style' => "font-family: $attributes->fontFamily"];
                        },
                    ],
                ],
            ],
        ];
    }
}
