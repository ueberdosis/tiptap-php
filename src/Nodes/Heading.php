<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Heading extends Node
{
    public static $name = 'heading';

    public static function renderHTML($node)
    {
        return "h{$node->attrs->level}";
    }

    private static function getLevel($value)
    {
        preg_match("/^h([1-6])$/", $value, $match);

        return $match[1] ?? null;
    }

    public static function parseHTML($DOMNode)
    {
        return (boolean) self::getLevel($DOMNode->nodeName);
    }

    public static function data($DOMNode)
    {
        return [
            'type' => 'heading',
            'attrs' => [
                'level' => self::getLevel($DOMNode->nodeName),
            ],
        ];
    }
}
