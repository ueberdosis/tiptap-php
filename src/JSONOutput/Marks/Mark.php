<?php

namespace Tiptap\JSONOutput\Marks;

class Mark
{
    public $type = 'mark';

    public function parseHTML($DOMNode)
    {
        return false;
    }

    public function data($DOMNode)
    {
        return [];
    }
}
