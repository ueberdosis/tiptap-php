<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class OrderedList extends Node
{
    public static $name = 'orderedList';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'ol',
                'getAttrs' => function ($DOMNode) {
                    if (!$DOMNode->getAttribute('start')) {
                        return null;
                    }

                    return [
                        'order' => (int) $DOMNode->getAttribute('start'),
                    ];
                }
            ],
        ];
    }

    public static function renderHTML($node)
    {
        $attrs = [];

        if (isset($node->attrs->order)) {
            $attrs['start'] = $node->attrs->order;
        }

        return [
            'tag' => 'ol',
            'attrs' => $attrs,
        ];
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'orderedList',
        ];
    }
}
