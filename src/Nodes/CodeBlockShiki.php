<?php

namespace Tiptap\Nodes;

use DomainException;
use Tiptap\Utils\HTML;
use Spatie\ShikiPhp\Shiki;

class CodeBlockShiki extends CodeBlock
{
    public function addOptions()
    {
        return [
            'languageClassPrefix' => 'skiki ',
            'HTMLAttributes' => [],
            'defaultLanguage' => 'html',
            'theme' => 'nord',
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        $code = $node->content[0]->text ?? '';

        if($node->attrs->language === null) {
            $lang = str_replace('language-', '', $node->attrs->language);
        } else {
            $lang = $this->options['defaultLanguage']; // skiki requires a language, set default to html
        }

        try {
            $content = Shiki::highlight(
                code: $code,
                language: $lang,
                theme: 'nord',
            );
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
