<?php

namespace Tiptap\Marks;

use Tiptap\Core\Mark;

class Link extends Mark
{
    public static $name = 'link';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'a[href]',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'href' => [],
            'target' => [],
            'rel' => [],
        ];
    }

    public function renderHTML($mark)
    {
        return ['a', (array) $mark->attrs, 0];
    }
}
