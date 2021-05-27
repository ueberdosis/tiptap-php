<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Link extends Mark
{
    protected $name = 'link';

    public function renderHTML()
    {
        $attrs = [];

        if (isset($this->mark->attrs->target)) {
            $attrs['target'] = $this->mark->attrs->target;
        }

        if (isset($this->mark->attrs->rel)) {
            $attrs['rel'] = $this->mark->attrs->rel;
        }

        $attrs['href'] = $this->mark->attrs->href;

        return [
            'tag' => 'a',
            'attrs' => $attrs,
        ];
    }
}
