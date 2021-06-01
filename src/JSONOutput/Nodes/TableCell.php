<?php

namespace Tiptap\JSONOutput\Nodes;

class TableCell extends Node
{
    public $name = 'table_cell';

    public function parseHTML($DOMNode)
    {
        return $DOMNode->nodeName === 'td';
    }

    public function data($DOMNode)
    {
        $data = [
            'type' => $this->name,
        ];

        $attrs = [];
        if ($colspan = $DOMNode->getAttribute('colspan')) {
            $attrs['colspan'] = intval($colspan);
        }
        if ($colwidth = $DOMNode->getAttribute('data-colwidth')) {
            $widths = array_map(function ($w) {
                return intval($w);
            }, explode(',', $colwidth));
            if (count($widths) === $attrs['colspan']) {
                $attrs['colwidth'] = $widths;
            }
        }
        if ($rowspan = $DOMNode->getAttribute('rowspan')) {
            $attrs['rowspan'] = intval($rowspan);
        }

        if (! empty($attrs)) {
            $data['attrs'] = $attrs;
        }

        return $data;
    }
}
