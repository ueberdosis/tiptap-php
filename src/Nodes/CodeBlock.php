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
                'getAttrs' => function ($DOMNode) {
                    $language = preg_replace("/^language-/", "", $DOMNode->childNodes[0]->getAttribute('class'));

                    if (!$language) {
                        return null;
                    }

                    return [
                        'language' => $language,
                    ];
                }
            ],
        ];
    }

    public static function renderHTML($node)
    {
        return ['pre', 'code'];
    }
}
