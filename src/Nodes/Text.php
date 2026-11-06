<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class Text extends Node
{
    public static $name = 'text';

    public static $inline = true;

    public function parseHTML()
    {
        return [
            [
                'tag' => '#text',
            ],
        ];
    }
}
