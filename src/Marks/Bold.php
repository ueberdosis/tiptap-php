<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public static function renderHTML($mark)
    {
        return 'strong';
    }

    public static function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'strong' || $DOMNode->nodeName === 'b';
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'bold',
        ];
    }
}
