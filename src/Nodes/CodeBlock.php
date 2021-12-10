<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class CodeBlock extends Node
{
    public static $name = 'codeBlock';

    public static function parseHTML($DOMNode)
    {
        return [
            [
                'tag' => 'pre',
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return ['pre', 'code'];
    }

    public static function data($DOMNode)
    {
        $language = preg_replace("/^language-/", "", $DOMNode->childNodes[0]->getAttribute('class'));

        if ($language) {
            return [
                'type' => 'codeBlock',
                'attrs' => [
                    'language' => $language,
                ],
            ];
        }

        return [
            'type' => 'codeBlock',
        ];
    }
}
