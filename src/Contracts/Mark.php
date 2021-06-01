<?php

namespace Tiptap\Contracts;

class Mark
{
    protected static $name;

    public static function renderHTML($mark)
    {
        return null;
    }

    public static function parseHTML($DOMNode)
    {
        return false;
    }

    public static function data($DOMNode)
    {
        return [];
    }
}
