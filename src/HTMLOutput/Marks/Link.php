<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Link extends Mark
{
    public $name = 'link';

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
