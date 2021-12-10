<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Image extends Node
{
    public static $name = 'image';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'img[src]',
                'getAttrs' => function ($DOMNode) {
                    $attrs = [];
                    if ($alt = $DOMNode->getAttribute('alt')) {
                        $attrs['alt'] = $alt;
                    }

                    if ($title = $DOMNode->getAttribute('title')) {
                        $attrs['title'] = $title;
                    }

                    $attrs['src'] = $DOMNode->getAttribute('src');

                    return $attrs;
                },
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'image',
        ];
    }
}
