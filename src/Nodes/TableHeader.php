<?php

namespace Tiptap\Nodes;

use Tiptap\Utils\HTML;

class TableHeader extends TableCell
{
    public static $name = 'tableHeader';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'th',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return [
            'th',
            HTML::mergeAttributes(
                $this->options['HTMLAttributes'],
                $HTMLAttributes,
            ),
            0,
        ];
    }

    public static function wrapper($DOMNode)
    {
        if (
            $DOMNode->childNodes->length === 1
            && $DOMNode->childNodes[0]->nodeName == "p"
        ) {
            return null;
        }

        return [
            'type' => 'paragraph',
        ];
    }
}
