<?php

namespace Tiptap\JSONOutput\Nodes;

class TableHeader extends TableCell
{
    public $name = 'table_header';

    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'th';
    }
}
