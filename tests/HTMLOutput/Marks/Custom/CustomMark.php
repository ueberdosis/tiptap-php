<?php

namespace Tiptap\Tests\HTMLOutput\Marks\Custom;

use Tiptap\HTMLOutput\Contracts\Mark;

class CustomMark extends Mark
{
    public function matching()
    {
        return $this->mark->type === 'custom_mark';
    }

    public function renderHTML()
    {
        return 'custom_mark';
    }
}
