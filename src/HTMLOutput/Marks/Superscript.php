<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Superscript extends Mark
{
    protected $name = 'superscript';

    public function renderHTML()
    {
        return 'sup';
    }
}
