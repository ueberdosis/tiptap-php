<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class OrderedList extends Node
{
    public static $name = 'orderedList';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'ol',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'order' => [
                'parseHTML' => fn ($DOMNode) => (int) $DOMNode->getAttribute('start') ?: null,
                'renderHTML' => fn ($attributes) => ($attributes->order ?? null) ? ['start' => $attributes->order] : null,
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return ['ol', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}
