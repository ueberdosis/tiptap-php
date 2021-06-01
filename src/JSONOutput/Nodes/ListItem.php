<?php

namespace Tiptap\JSONOutput\Nodes;

class ListItem extends Node
{
    public $wrapper = [
        'type' => 'paragraph',
    ];

    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'li';
    }

    public function data($DOMNode)
    {
        if ($DOMNode->childNodes->length === 1
                && $DOMNode->childNodes[0]->nodeName == "p") {
            $this->wrapper = null;
        }

        return [
            'type' => 'list_item',
        ];
    }
}
