<?php

namespace Tiptap\Tests\HTMLOutput\Marks\Custom;

use Tiptap\HTMLOutput\Marks\Mark;

class CustomMark extends Mark
{
    public function matching()
    {
        return $this->mark->type === 'custom_mark';
    }

    public function tag()
    {
        return 'custom_mark';
    }
}
