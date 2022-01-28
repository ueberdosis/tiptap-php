<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class CodeBlock extends Node
{
    public static $name = 'codeBlock';

    public static $marks = '';

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
                'tag' => 'pre',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'language' => [
                'parseHTML' => function ($DOMNode) {
                    return preg_replace("/^language-/", "", $DOMNode->childNodes[0]->getAttribute('class')) ?: null;
                },
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        // TODO: Add language class
        return ['pre', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), ['code', 0]];
    }
}
