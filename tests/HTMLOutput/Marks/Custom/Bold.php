<?php

namespace Tiptap\Tests\Marks\Custom;

use Tiptap\Core\Mark;

class Bold extends Mark
{
    public static $name = 'bold';

    public function renderHTML($DOMNode)
    {
        return 'b';
    }
}
