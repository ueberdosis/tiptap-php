<?php

namespace Tiptap\Tests\DOMParser\Nodes;

use Tiptap\Core\Node;

class BlockquoteCite extends Node
{
    public static $name = 'blockquoteCite';

    public static $noContent = true;

    public function addAttributes(): array
    {
        return [
            'quote' => [
                'parseHTML' => fn ($domNode) => $domNode->childNodes[0]->childNodes[0]->textContent ?? '',
            ],
            'author' => [
                'parseHTML' => fn ($domNode) => $domNode->childNodes[1]->textContent ?? '',
            ],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'blockquote',
                'getAttrs' => fn ($domNode) => isset($domNode->childNodes[1]) && $domNode->childNodes[1]->tagName === 'cite',
            ],
        ];
    }
}
