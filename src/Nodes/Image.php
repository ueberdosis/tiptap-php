<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Image extends Node
{
    public static $name = 'image';

    public static function renderHTML($node)
    {
        return [
            'tag' => 'img',
            'attrs' => $node->attrs,
        ];
    }

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'img';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'image',
            'attrs' => [
                'alt' => $DOMNode->hasAttribute('alt') ? $DOMNode->getAttribute('alt') : null,
                'src' => $DOMNode->hasAttribute('src') ? $DOMNode->getAttribute('src') : null,
                'title' => $DOMNode->hasAttribute('title') ? $DOMNode->getAttribute('title') : null,
            ],
        ];
    }
}
