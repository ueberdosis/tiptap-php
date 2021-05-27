<?php

namespace Tiptap\HTMLOutput\Nodes;

use Tiptap\HTMLOutput\Contracts\Node;

class TableCell extends Node
{
    public $name = 'table_cell';

    protected function getAttrs($node)
    {
        $attrs = [];

        if (isset($node->attrs)) {
            if (isset($node->attrs->colspan)) {
                $attrs['colspan'] = $node->attrs->colspan;
            }

            if (isset($node->attrs->colwidth)) {
                if ($widths = $node->attrs->colwidth) {
                    if (count($widths) === $attrs['colspan']) {
                        $attrs['data-colwidth'] = implode(',', $widths);
                    }
                }
            }

            if (isset($node->attrs->rowspan)) {
                $attrs['rowspan'] = $node->attrs->rowspan;
            }
        }

        return $attrs;
    }

    public function renderHTML($node)
    {
        return [
            'tag' => 'td',
            'attrs' => $this->getAttrs($node),
        ];
    }
}
