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



    $output = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<p><mark data-color="red" style="background-color: red;">Example</mark> Text</p>';

    expect($output)->toEqual($html);
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

    $output = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual($document);
});

test('color is parsed from the background color inline style', function () {
    $html = '<p><mark style="background-color: #ffcc00">Example</mark> Text</p>';

    $output = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($html)->getDocument();

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

    expect($output)->toEqual($document);
});
