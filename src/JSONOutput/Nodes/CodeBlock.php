<?php

namespace Tiptap\JSONOutput\Nodes;

class CodeBlock extends Node
{
    public function parseHTML()
    {
        return
            $this->DOMNode->nodeName === 'code' &&
            $this->DOMNode->parentNode->nodeName === 'pre';
    }

    private function getLanguage()
    {
        return preg_replace("/^language-/", "", $this->DOMNode->getAttribute('class'));
    }

    public function data()
    {
        if ($language = $this->getLanguage()) {
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
