<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Subscript extends Mark
{
    public static $name = 'subscript';

    public static function renderHTML($mark)
    {
        return 'sub';
    }
}
