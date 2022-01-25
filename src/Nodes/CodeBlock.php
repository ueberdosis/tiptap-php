<?php

namespace Tiptap\Nodes;

use Tiptap\Core\Node;

class CodeBlock extends Node
{
    public static $name = 'codeBlock';

    public static $marks = '';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'pre',
            ],
        ];
    }

    public static function addAttributes()
    {
        return [
            'language' => [
                'parseHTML' => function ($DOMNode) {
                    return preg_replace("/^language-/", "", $DOMNode->childNodes[0]->getAttribute('class')) ?: null;
                },
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['pre', ['code', 0]];
    }
}
