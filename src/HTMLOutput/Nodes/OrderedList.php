<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class OrderedList extends Node
{
    protected $name = 'ordered_list';

    public function renderHTML()
    {
        $attrs = [];

        if (isset($this->node->attrs->order)) {
            $attrs['start'] = $this->node->attrs->order;
        }

        return [
            'tag' => 'ol',
            'attrs' => $attrs,
        ];
    }
}
