<?php

namespace Tiptap\JSONOutput\Nodes;

class Image extends Node
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'img';
    }

    public function data($DOMNode)
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
