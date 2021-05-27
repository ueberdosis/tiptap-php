<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Underline extends Mark
{
    public static $name = 'underline';

    public static function renderHTML($mark)
    {
        return 'u';
    }
}
