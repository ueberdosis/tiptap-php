<?php

namespace Tiptap\HTML\Nodes;

class TableHeader extends TableCell
{
    protected $nodeType = 'table_header';

    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'th';
    }
}
