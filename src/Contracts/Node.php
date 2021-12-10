<?php

namespace Tiptap\Contracts;

class Node
{
    public static $name;

    public static $marks = '_';

    public static function parseHTML($DOMNode)
    {
        return [];
    }

    public static function renderHTML($node)
    {
        return null;
    }

    public static function text($node)
    {
        return null;
    }

    public static function wrapper($DOMNode)
    {
        return null;
    }

    public static function data($DOMNode)
    {
        return [];
    }
}
