<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Subscript extends Mark
{
    public $name = 'subscript';

    public function renderHTML($mark)
    {
        return 'sub';
    }
}
