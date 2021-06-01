<?php

namespace Tiptap\JSONOutput\Marks;

class Bold extends Mark
{
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
