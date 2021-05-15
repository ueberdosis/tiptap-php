<?php

namespace Tiptap\HTML\Nodes;

class TableHeader extends TableCell
{
    protected $name = 'table_header';

    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'th';
    }
}
