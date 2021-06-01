<?php

namespace Tiptap\JSONOutput\Marks;

class Mark
{
    public $type = 'mark';

    public static function parseHTML($DOMNode)
    {
        return false;
    }

    public static function data($DOMNode)
    {
        return [];
    }
}
