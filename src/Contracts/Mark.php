<?php

namespace Tiptap\Contracts;

class Mark
{
    public static $name;

    public static function renderHTML($mark)
    {
        return null;
    }

    public static function parseHTML($DOMNode)
    {
        return [];
    }
}
