<?php

namespace Tiptap\JSONOutput\Nodes;

class OrderedList extends Node
{
    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'ol';
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
