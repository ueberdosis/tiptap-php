<?php

namespace Tiptap\Tests\JSONOutput\Marks\Custom;

use Tiptap\JSONOutput\Marks\Mark;

class Bold extends Mark
{
    public function matching()
    {
        return $this->DOMNode->nodeName === 'strong' || $this->DOMNode->nodeName === 'b';
    }

    public function data()
    {
        return [
            'type' => 'bold',
        ];
    }
}
