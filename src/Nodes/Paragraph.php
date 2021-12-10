<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'p',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return 'p';
    }
}
