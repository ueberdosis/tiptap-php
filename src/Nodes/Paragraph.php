<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Paragraph extends Node
{
    public static $name = 'paragraph';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'p',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['p'];
    }
}
