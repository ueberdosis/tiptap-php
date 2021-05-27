<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Code extends Mark
{
    public static $name = 'code';

    public static function renderHTML($mark)
    {
        return 'code';
    }
}
