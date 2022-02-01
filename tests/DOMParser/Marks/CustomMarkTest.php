<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Utils\HTML;

class CustomMark extends \Tiptap\Core\Mark
{
    public static string $name = 'custom';

    public function renderHTML($mark, array $HTMLAttributes = []): array
    {
        return [
            'span',
            HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes),
            0,
        ];
    }

    public function parseHTML(): array
    {
        return [
            [
                'tag' => 'span',
            ],
        ];
    }

    public function addAttributes()
    {
        return [
            'foo' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->getAttribute('data-foo') ?: null,
            ],
            'fruit' => [],
        ];
    }
}

test('b and strong get rendered correctly', function () {
    $html = '<p><span data-foo="bar" fruit="banana">Example</span> text</p>';

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new CustomMark,
            ],
        ]))
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'custom',
                                'attrs' => [
                                    'foo' => 'bar',
                                    'fruit' => 'banana',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' text',
                    ],
                ],
            ],
        ],
    ]);
});
