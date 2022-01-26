<?php

namespace Tiptap\Nodes;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        // TODO: Add HTMLAttributes
        return ['th', self::getAttrs($node), 0];
    }
}
