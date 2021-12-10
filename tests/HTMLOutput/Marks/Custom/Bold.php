<?php

namespace Tiptap\Tests\Marks\Custom;

use Tiptap\Contracts\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public static function renderHTML($DOMNode)
    {
        return 'b';
    }
}
