<?php

namespace Tiptap\HTMLOutput\Nodes;

class TableHeader extends TableCell
{
    protected $name = 'table_header';

    public function renderHTML()
    {
        return [
            'tag' => 'th',
            'attrs' => $this->getAttrs(),
        ];
    }
}
