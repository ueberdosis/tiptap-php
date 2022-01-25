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
        $attrs = [];

        if (isset($mark->attrs->target)) {
            $attrs['target'] = $mark->attrs->target;
        }

        if (isset($mark->attrs->rel)) {
            $attrs['rel'] = $mark->attrs->rel;
        }

        $attrs['href'] = $mark->attrs->href;

        return [
            'tag' => 'a',
            'attrs' => $attrs,
        ];
    }
}
