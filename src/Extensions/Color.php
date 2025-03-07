<?php

namespace Tiptap\Extensions;

use Tiptap\Core\Extension;
use Tiptap\Utils\InlineStyle;

class Color extends Extension
{
    public static $name = 'color';

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
                    'color' => [
                        'default' => null,
                        'parseHTML' => function ($DOMNode) {
                            $attribute = InlineStyle::getAttribute($DOMNode, 'color');

                            if ($attribute === null) {
                                return null;
                            }

                            return preg_replace('/[\'"]+/', '', $attribute);
                        },
                        'renderHTML' => function ($attributes) {
                            if (!isset($attributes?->color)) {
                                return null;
                            }

                            return ['style' => "color: {$attributes->color}"];
                        },
                    ],
                ],
            ],
        ];
    }
}