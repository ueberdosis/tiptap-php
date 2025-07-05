<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class Details extends Node
{
    public static $name = 'details';

    public function addOptions()
    {
        return [
            'persist' => false,
            'openClassName' => 'is-open',
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'details',
            ],
        ];
    }

    public function addAttributes()
    {
        if (! $this->options['persist']) {
            return [];
        }

        return [
            'open' => [
                'default' => false,
                'parseHTML' => fn ($DOMNode) => $DOMNode->hasAttribute('open'),
                'renderHTML' => fn ($attributes) => $attributes->open ? ['open' => 'open'] : [],
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return [
            'details',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }
}
