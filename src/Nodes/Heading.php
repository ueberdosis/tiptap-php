<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class Heading extends Node
{
    public static $name = 'heading';

    public static $options = [
        'levels' => [1, 2, 3, 4, 5, 6],
    ];

    public static function parseHTML()
    {
        return array_map(function ($level) {
            return [
                'tag' => "h{$level}",
                'attrs' => [
                    'level' => $level,
                ],
            ];
        }, self::$options['levels']);
    }

    public static function renderHTML($node)
    {
        $hasLevel = in_array($node->attrs->level, self::$options['levels']);

        $level = $hasLevel ?
            $node->attrs->level :
            self::$options['levels'][0];

        return ["h{$level}"];
    }
}
