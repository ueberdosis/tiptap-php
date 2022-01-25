<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class OrderedList extends Node
{
    public static $name = 'orderedList';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'ol',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'order' => [
                'parseHTML' => fn ($DOMNode) => (int) $DOMNode->getAttribute('start') ?: null,
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
}
