<?php

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'table_header';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return [
            'tag' => 'th',
            'attrs' => self::getAttrs($node),
        ];
    }

    // TODO: Duplicate with TableCell, but self:: shouldn’t reference TableCell
    public static function data($DOMNode)
    {
        $data = [
            'type' => self::$name,
        ];

        $attrs = [];

        if ($colspan = $DOMNode->getAttribute('colspan')) {
            $attrs['colspan'] = intval($colspan);
        }

        if ($colwidth = $DOMNode->getAttribute('data-colwidth')) {
            $widths = array_map(function ($w) {
                return intval($w);
            }, explode(',', $colwidth));
            if (count($widths) === $attrs['colspan']) {
                $attrs['colwidth'] = $widths;
            }
        }

        if ($rowspan = $DOMNode->getAttribute('rowspan')) {
            $attrs['rowspan'] = intval($rowspan);
        }

        if (! empty($attrs)) {
            $data['attrs'] = $attrs;
        }

        return $data;
    }
}
