<?php

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public static function parseHTML()
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return [
            'tag' => 'th',
            'attrs' => self::getAttrs($node),
        ];
    }
}
