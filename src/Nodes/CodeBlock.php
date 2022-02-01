<?php declare(strict_types=1);

namespace Tiptap\Nodes;

use Tiptap\Core\Node;
use Tiptap\Utils\HTML;

class CodeBlock extends Node
{
    public static string $name = 'codeBlock';

    public static string $marks = '';

    public function addOptions(): array
    {
        return [
            'languageClassPrefix' => 'language-',
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'pre',
            ],
        ];
    }

    public function addAttributes(): array
    {
        return [
            'language' => [
                'parseHTML' => function ($DOMNode) {
                    return preg_replace(
                        "/^" . $this->options['languageClassPrefix'] . "/",
                        "",
                        $DOMNode->childNodes[0]->getAttribute('class')
                    ) ?: null;
                },
                'rendered' => false,
            ],
        ];
    }

    public function renderHTML($node, array $HTMLAttributes = []): ?array
    {
        return [
            'pre',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            [
                'code',
                [
                    'class' => $node->attrs->language ?? null
                            ? $this->options['languageClassPrefix'] . $node->attrs->language
                            : null,
                ],
                0,
            ],
        ];
    }
}
