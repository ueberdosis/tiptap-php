<?php

namespace Tiptap\Tests\DOMParser\Nodes;

use Tiptap\Core\Node;

class HighPriorityParagraph extends Node
{
    public static $name = 'highPriorityParagraph';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'p',
                'priority' => 60,
            ],
        ];
    }
}
