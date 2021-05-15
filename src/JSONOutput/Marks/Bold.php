<?php

namespace Tiptap\JSONOutput\Marks;

class Bold extends Mark
{
    public function parseHTML()
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
