<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Strike extends Mark
{
    public $name = 'strike';

    public function renderHTML($mark)
    {
        return 'strike';
    }
}
