<?php

namespace Tiptap\Tests\HTMLOutput\Marks\Custom;

use Tiptap\HTMLOutput\Marks\Mark;

class Bold extends Mark
{
    protected $markType = 'bold';
    protected $tagName = 'b';
}
