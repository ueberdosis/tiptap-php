<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class TableCell extends Node
{
    protected $name = 'table_cell';

    protected function getAttrs()
    {
        $attrs = [];

        if (isset($this->node->attrs)) {
            if (isset($this->node->attrs->colspan)) {
                $attrs['colspan'] = $this->node->attrs->colspan;
            }

            if (isset($this->node->attrs->colwidth)) {
                if ($widths = $this->node->attrs->colwidth) {
                    if (count($widths) === $attrs['colspan']) {
                        $attrs['data-colwidth'] = implode(',', $widths);
                    }
                }
            }

            if (isset($this->node->attrs->rowspan)) {
                $attrs['rowspan'] = $this->node->attrs->rowspan;
            }
        }

        return $attrs;
    }

    public function renderHTML()
    {
        return [
            'tag' => 'td',
            'attrs' => $this->getAttrs(),
        ];
    }
}
