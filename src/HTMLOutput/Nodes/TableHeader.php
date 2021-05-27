<?php

namespace Tiptap\HTMLOutput\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'table_header';

    public static function renderHTML($node)
    {
        return [
            'tag' => 'th',
            'attrs' => self::getAttrs($node),
        ];
    }
}
