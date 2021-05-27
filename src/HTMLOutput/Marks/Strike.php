<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Strike extends Mark
{
    public static $name = 'strike';

    public static function renderHTML($mark)
    {
        return 'strike';
    }
}
