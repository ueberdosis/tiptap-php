<?php

namespace Tiptap\HTMLOutput\Marks;

class Bold extends Mark
{
    protected $name = 'bold';

    public function tag()
    {
        return 'strong';
    }
}
