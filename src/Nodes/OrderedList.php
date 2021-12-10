<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class OrderedList extends Node
{
    public static $name = 'ordered_list';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'ol',
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
            'type' => 'ordered_list',
            'attrs' => [
                'order' =>
                    $DOMNode->getAttribute('start') ?
                    (int) $DOMNode->getAttribute('start') :
                    1,
            ],
        ];
    }
}
