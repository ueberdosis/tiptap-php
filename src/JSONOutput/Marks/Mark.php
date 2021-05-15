<?php

namespace Tiptap\JSONOutput\Marks;

class Mark
{
    public $type = 'mark';

    protected $DOMNode;

    public function __construct($DOMNode)
    {
        $this->DOMNode = $DOMNode;
    }

    public function parseHTML()
    {
        return false;
    }

    public function data()
    {
        return [];
    }
}
