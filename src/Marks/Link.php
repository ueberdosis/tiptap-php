<?php

namespace Tiptap\Marks;

use Tiptap\Contracts\Mark;

class Link extends Mark
{
    public static $name = 'link';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'a[href]',
            ],
        ];
    }

    public static function renderHTML($mark)
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

    public static function data($DOMNode)
    {
        $data = [
            'type' => 'link',
        ];

        $attrs = [];

        if ($target = $DOMNode->getAttribute('target')) {
            $attrs['target'] = $target;
        }

        if ($rel = $DOMNode->getAttribute('rel')) {
            $attrs['rel'] = $rel;
        }

        $attrs['href'] = $DOMNode->getAttribute('href');

        $data['attrs'] = $attrs;

        return $data;
    }
}
