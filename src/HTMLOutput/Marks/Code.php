<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Code extends Mark
{
    public $name = 'code';

    public function renderHTML()
    {
        return 'code';
    }
}
