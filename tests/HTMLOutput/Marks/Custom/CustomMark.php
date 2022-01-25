<?php

namespace Tiptap\Tests\Marks\Custom;

use Tiptap\HTMLOutput\Core\Mark;

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
