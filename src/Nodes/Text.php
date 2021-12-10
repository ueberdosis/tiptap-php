<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Text extends Node
{
    public static $name = 'text';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => '#text',
            ],
        ];
    }
}
