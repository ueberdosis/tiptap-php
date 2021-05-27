<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class OrderedList extends Node
{
    public $name = 'ordered_list';

    public function renderHTML($node)
    {
        $attrs = [];

        if (isset($node->attrs->order)) {
            $attrs['start'] = $node->attrs->order;
        }

        return [
            'tag' => 'ol',
            'attrs' => $attrs,
        ];
    }
}
