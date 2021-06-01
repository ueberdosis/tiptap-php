<?php

namespace Tiptap\JSONOutput\Marks;

class Bold extends Mark
{
    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'strong' || $DOMNode->nodeName === 'b';
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'bold',
        ];
    }
}
