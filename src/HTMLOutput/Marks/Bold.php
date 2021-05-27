<?php

namespace Tiptap\HTMLOutput\Marks;

use Tiptap\HTMLOutput\Contracts\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public static function renderHTML($mark)
    {
        return 'strong';
    }
}
