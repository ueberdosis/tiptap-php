<?php

namespace Tiptap\HTMLOutput\Nodes;

class OrderedList extends Node
{
    protected $name = 'ordered_list';
    protected $tagName = 'ol';

    public function tag()
    {
        $attrs = [];

        if (isset($this->node->attrs->order)) {
            $attrs['start'] = $this->node->attrs->order;
        }

        return [
            'tag' => $this->tagName,
            'attrs' => $attrs,
        ];
    }
}
