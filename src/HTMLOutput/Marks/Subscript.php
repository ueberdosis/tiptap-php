<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Subscript extends Mark
{
    protected $name = 'subscript';

    public function renderHTML()
    {
        return 'sub';
    }
}
