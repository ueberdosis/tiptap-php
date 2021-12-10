<?php

namespace Tiptap\Nodes;

use Tiptap\Contracts\Node;

class CodeBlock extends Node
{
    public static $name = 'code_block';

    public static function parseHTML($DOMNode)
    {
        return
            $DOMNode->nodeName === 'code' &&
            $DOMNode->parentNode->nodeName === 'pre';
    }

    public static function renderHTML($node)
    {
        return ['pre', 'code'];
    }

    public static function data($DOMNode)
    {
        $language = preg_replace("/^language-/", "", $DOMNode->getAttribute('class'));

        if ($language) {
            return [
                'type' => 'code_block',
                'attrs' => [
                    'language' => $language,
                ],
            ];
        }

        return [
            'type' => 'code_block',
        ];
    }
}
