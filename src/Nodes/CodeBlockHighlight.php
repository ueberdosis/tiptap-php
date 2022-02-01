<?php

namespace Tiptap\Nodes;

use DomainException;
use Highlight\Highlighter;
use Tiptap\Utils\HTML;

class CodeBlockHighlight extends CodeBlock
{
    public function addOptions(): array
    {
        return [
            'languageClassPrefix' => 'hljs ',
            'HTMLAttributes' => [],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = []): ?array
    {
        $code = $node->content[0]->text ?? null;

        try {
            $highlighter = new Highlighter();

            if ($node->attrs->language ?? null) {
                $result = $highlighter->highlight($node->attrs->language, $code);
            } else {
                $result = $highlighter->highlightAuto($code);
            }

            $mergedAttributes = HTML::mergeAttributes(
                [
                    'class' => $this->options['languageClassPrefix'] . $result->language,
                ],
                array_merge(
                    $this->options['HTMLAttributes'],
                    $HTMLAttributes
                ),
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
