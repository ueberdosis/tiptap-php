<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Superscript extends Mark
{
    public static $name = 'superscript';

    public static function renderHTML($mark)
    {
        return 'sup';
    }
}
