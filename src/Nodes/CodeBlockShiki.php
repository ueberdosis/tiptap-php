<?php

namespace Tiptap\Nodes;

use DomainException;
use Highlight\Highlighter;
use Tiptap\Utils\HTML;

class CodeBlockHighlight extends CodeBlock
{
    public function addOptions()
    {
        return [
            'languageClassPrefix' => 'skiki ',
            'HTMLAttributes' => [],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $code = $node->content[0]->text ?? '';

        if($node->attrs->language === null) {
            $lang = str_replace('language-', '', $node->attrs->language);
        } else {
            $lang = 'html'; // skiki requires a language, set default to html
        }

        try {
            $result = Shiki::highlight(
                code: $code,
                language: $lang,
                theme: 'nord',
            );
            
            $mergedAttributes = HTML::mergeAttributes(
                [
                    'class' => $this->options['languageClassPrefix'] . $result->language,
                ],
                $this->options['HTMLAttributes'],
                $HTMLAttributes,
            );

            $renderedAttributes = HTML::renderAttributes($mergedAttributes);

            $content = "<pre><code" . $renderedAttributes . ">";
            $content .= $result->value;
            $content .= "</code></pre>";
        } catch (DomainException $exception) {
            $mergedAttributes = HTML::mergeAttributes(
                $this->options['HTMLAttributes'],
                $HTMLAttributes,
            );

            $renderedAttributes = HTML::renderAttributes($mergedAttributes);

            $content = "<pre><code" . $renderedAttributes . ">";
            $content .= htmlentities($code);
            $content .= "</code></pre>";
        }

        return [
            'content' => $content,
        ];
    }
}
