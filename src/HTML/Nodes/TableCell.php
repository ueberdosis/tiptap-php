<?php

namespace Tiptap\HTML\Nodes;

class TableCell extends Node
{
    protected $name = 'table_cell';

    public function parseHTML()
    {
        return $this->DOMNode->nodeName === 'td';
    }

    public function data()
    {
        $data = [
            'type' => $this->name,
        ];

        $attrs = [];
        if ($colspan = $this->DOMNode->getAttribute('colspan')) {
            $attrs['colspan'] = intval($colspan);
        }
        if ($colwidth = $this->DOMNode->getAttribute('data-colwidth')) {
            $widths = array_map(function ($w) {
                return intval($w);
            }, explode(',', $colwidth));
            if (count($widths) === $attrs['colspan']) {
                $attrs['colwidth'] = $widths;
            }
        }
        if ($rowspan = $this->DOMNode->getAttribute('rowspan')) {
            $attrs['rowspan'] = intval($rowspan);
        }

        if (!empty($attrs)) {
            $data['attrs'] = $attrs;
        }

        return $data;
    }
}
