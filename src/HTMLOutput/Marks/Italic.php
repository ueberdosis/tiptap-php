<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Italic extends Mark
{
    public $name = 'italic';

    public function renderHTML($mark)
    {
        return 'em';
    }
}
