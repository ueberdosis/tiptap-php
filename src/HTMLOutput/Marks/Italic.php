<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Italic extends Mark
{
    public static $name = 'italic';

    public static function renderHTML($mark)
    {
        return 'em';
    }
}
