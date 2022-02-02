<?php

namespace Tiptap\Core;

class Node
{
    public static $name;

    public static $priority = 100;

    public static $topNode = false;

    public static $marks = '_';

    public $options = [];

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->addOptions(), $options);
    }

    public function addOptions()
    {
        return [];
    }

    public function addAttributes()
    {
        return [];
    }

    public function parseHTML()
    {
        return [];
    }

    public function renderHTML($node)
    {
        return null;
    }

    public static function wrapper($DOMNode)
    {
        return null;
    }
}
