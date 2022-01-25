<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class CodeBlock extends Node
{
    public static $name = 'codeBlock';

    public static $marks = '';

    public static function parseHTML()
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

    public static function renderHTML($node)
    {
        return ['pre', 'code'];
    }
}
