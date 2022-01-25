<?php

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public function renderHTML($node)
    {
        return [
            'tag' => 'th',
            'attrs' => self::getAttrs($node),
        ];
    }
}
