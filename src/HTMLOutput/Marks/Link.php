<?php

namespace Tiptap\HTMLOutput\Marks;

class Link extends Mark
{
    protected $name = 'link';
    protected $tagName = 'a';

    public function tag()
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
            [
                'tag' => $this->tagName,
                'attrs' => $attrs,
            ],
        ];
    }
}
