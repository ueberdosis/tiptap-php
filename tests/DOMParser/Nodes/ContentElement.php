<?php

namespace Tiptap\Tests\DOMParser\Nodes;

use Tiptap\Core\Node;

class ContentElement extends Node
{
    public static $name = 'contentElement';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'div',
                'contentElement' => fn ($domNode) => new \DOMElement('div', $domNode->lastChild->textContent),
                'getAttrs' => fn ($domNode) => $domNode->getAttribute('class') === 'contentElement',
            ],
        ];
    }
}
