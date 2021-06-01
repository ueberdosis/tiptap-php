<?php

namespace Tiptap\JSONOutput\Nodes;

class Heading extends Node
{
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
