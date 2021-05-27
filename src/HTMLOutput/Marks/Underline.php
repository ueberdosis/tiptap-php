<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Underline extends Mark
{
    protected $name = 'underline';

    public function renderHTML()
    {
        return 'u';
    }
}
