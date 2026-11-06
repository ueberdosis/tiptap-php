<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;

test('text align is rendered correctly', function ($alignment) {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'attrs' => [
                    'textAlign' => $alignment,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextAlign([
                    'types' => ['paragraph'],
                ]),
            ],
        ]))
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('<p style="text-align: ' . $alignment . ';">Example Text</p>');
})->with(['center', 'right', 'justify', 'start', 'end', 'inherit']);

test('default text align isn’t rendered', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'attrs' => [
                    'textAlign' => 'left',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextAlign([
                    'types' => ['paragraph'],
                ]),
            ],
        ]))
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('<p>Example Text</p>');
});

test('default text align is configureable', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'attrs' => [
                    'textAlign' => 'center',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextAlign([
                    'types' => ['paragraph'],
                    'defaultAlignment' => 'center',
                ]),
            ],
        ]))
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('<p>Example Text</p>');
});

test('invalid text alignment values omit generated attributes and preserve text', function ($format) {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'attrs' => ['textAlign' => 'left; position: fixed; inset: 0; z-index: 2147483647'],
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [new StarterKit(), new TextAlign(['types' => ['paragraph']])],
    ]))->setContent($format === 'json' ? json_encode($document) : $document)->getHTML();

    expect($html)->toEqual('<p>Example</p>');
})->with(['array', 'json']);
