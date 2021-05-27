<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Superscript extends Mark
{
    public $name = 'superscript';

    public function renderHTML($mark)
    {
        return 'sup';
    }
}
