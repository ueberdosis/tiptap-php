<?php

namespace Tiptap\JSONOutput\Nodes;

class Heading extends Node
{
    private function getLevel($value)
    {
        preg_match("/^h([1-6])$/", $value, $match);

        return $match[1] ?? null;
    }

    public function parseHTML($DOMNode)
    {
        return (boolean) $this->getLevel($DOMNode->nodeName);
    }

    public function data($DOMNode)
    {
        return [
            'type' => 'heading',
            'attrs' => [
                'level' => $this->getLevel($DOMNode->nodeName),
            ],
        ];
    }
}
