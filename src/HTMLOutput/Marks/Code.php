<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Code extends Mark
{
    protected $name = 'code';

    public function renderHTML()
    {
        return 'code';
    }
}
