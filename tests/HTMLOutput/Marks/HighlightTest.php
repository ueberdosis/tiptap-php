<?php

use Tiptap\Editor;

test('mark gets rendered correctly', function () {
    $document = [
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
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => 'red',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    $html = '<p><mark data-color="red" style="background-color: red;">Example</mark> Text</p>';

    expect((new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($document)->getHTML())->toEqual($html);
});

test('color is parsed from data attribute', function () {
    $html = '<p><mark data-color="red">Example</mark> Text</p>';

    $document = [
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
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => 'red',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Paragraph,
            new \Tiptap\Nodes\Text,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($html)->getDocument());
});

test('color is parsed from the background color inline style', function () {
    $html = '<p><mark style="background-color: #ffcc00">Example</mark> Text</p>';

    $document = [
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
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => '#ffcc00',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    expect($document)->toEqual((new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Paragraph,
            new \Tiptap\Nodes\Text,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($html)->getDocument());
});
