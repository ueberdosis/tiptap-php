<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Bold extends Mark
{
    public $name = 'bold';

    public function renderHTML()
    {
        return 'strong';
    }
}
