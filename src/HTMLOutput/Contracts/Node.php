<?php

namespace Tiptap\HTMLOutput\Contracts;

class Node
{
    protected static $name;

    public static function renderHTML($node)
    {
        return null;
    }

    public static function text($node)
    {
        return null;
    }
}
