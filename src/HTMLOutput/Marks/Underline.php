<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Underline extends Mark
{
    public $name = 'underline';

    public function renderHTML($mark)
    {
        return 'u';
    }
}
