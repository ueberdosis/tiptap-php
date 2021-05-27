<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Italic extends Mark
{
    protected $name = 'italic';

    public function renderHTML()
    {
        return 'em';
    }
}
