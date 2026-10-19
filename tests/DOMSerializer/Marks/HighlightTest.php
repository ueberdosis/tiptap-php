<?php

use Tiptap\Editor;

test('mark doesn’t allow specific colors by default', function () {
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

    $result = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<p><mark>Example</mark> Text</p>');
});

test('mark allows specific colors when configured', function ($color) {
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
                                    'color' => $color,
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

    $result = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight([
                'multicolor' => true,
            ]),
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<p><mark data-color="' . $color . '" style="background-color: ' . $color . ';">Example</mark> Text</p>');
})->with(['red', '#ff0000', 'rgb(255, 0, 0)', 'hsl(0, 100%, 50%)', 'var(--text-color)', ' red ']);

test('invalid highlight color values omit generated attributes and preserve text', function ($format) {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
                'marks' => [[
                    'type' => 'highlight',
                    'attrs' => ['color' => 'red; position: fixed; inset: 0; z-index: 2147483647'],
                ]],
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [new \Tiptap\Extensions\StarterKit(), new \Tiptap\Marks\Highlight(['multicolor' => true])],
    ]))->setContent($format === 'json' ? json_encode($document) : $document)->getHTML();

    expect($html)->toEqual('<p><mark>Example</mark></p>');
})->with(['array', 'json']);
