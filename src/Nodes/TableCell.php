<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class TableCell extends Node
{
    public static $name = 'tableCell';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'td',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'rowspan' => [
                'parseHTML' => fn ($DOMNode) => intval($DOMNode->getAttribute('rowspan')) ?: null,
            ],
            'colspan' => [
                'parseHTML' => fn ($DOMNode) => intval($DOMNode->getAttribute('colspan')) ?: null,
            ],
            'colwidth' => [
                'parseHTML' => function ($DOMNode) {
                    $colwidth = $DOMNode->getAttribute('data-colwidth');

                    if (! $colwidth) {
                        return null;
                    }

                    $widths = array_map(function ($w) {
                        return intval($w);
                    }, explode(',', $colwidth));

                    // TODO: Should be in the renderHTML function
                    // if (count($widths) === $attrs['colspan']) {
                    //     return $widths;
                    // }

                    return $widths;
                },
            ],
        ];
    }

    protected static function getAttrs($node)
    {
        $attrs = [];

        if (isset($node->attrs)) {
            if (isset($node->attrs->colspan)) {
                $attrs['colspan'] = $node->attrs->colspan;
            }

            if (isset($node->attrs->colwidth)) {
                if ($widths = $node->attrs->colwidth) {
                    if (count($widths) === $attrs['colspan']) {
                        $attrs['data-colwidth'] = implode(',', $widths);
                    }
                }
            }

            if (isset($node->attrs->rowspan)) {
                $attrs['rowspan'] = $node->attrs->rowspan;
            }
        }

        return $attrs;
    }

    public function renderHTML($node)
    {
        return ['td', self::getAttrs($node), 0];
    }
}
