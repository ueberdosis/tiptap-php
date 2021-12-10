<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Heading extends Node
{
    public static $name = 'heading';

    public static function parseHTML($DOMNode)
    {
        $levels = [1, 2, 3, 4, 5, 6];

        return array_map(function ($level) {
            return [
                'tag' => "h{$level}",
                'attrs' => [
                    'level' => $level,
                ],
            ];
        }, $levels);
    }

    public static function renderHTML($node)
    {
        return "h{$node->attrs->level}";
    }

    // public static function addAttributes()
    // {
    //     return [
    //         'level' => [
    //             'default' => 1,
    //         ],
    //     ];
    // }

    // public static function getAttributes($DOMNode)
    // {
    //     dd(self::addAttributes());
    // }
}
