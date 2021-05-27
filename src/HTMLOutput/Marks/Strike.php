<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Strike extends Mark
{
    protected $name = 'strike';

    public function renderHTML()
    {
        return 'strike';
    }
}
