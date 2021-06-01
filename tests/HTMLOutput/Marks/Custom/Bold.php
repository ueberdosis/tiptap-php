<?php

namespace Tiptap\Tests\Marks\Custom;

use Tiptap\HTMLOutput\Contracts\Mark;

class Bold extends Mark
{
    protected $markType = 'bold';
    public function renderHTML() {
return 'b';
}
