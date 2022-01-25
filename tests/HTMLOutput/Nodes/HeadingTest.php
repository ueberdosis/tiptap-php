<?php

use Tiptap\Editor;

test('heading node gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Headline',
                    ],
                ],
            ],
        ],
    ];

    $html = '<h2>Example Headline</h2>';

    expect((new Editor)->setContent($document)->getHTML())->toEndWith($html);
});

test('forbidden heading levels are transformed to a heading with an allowed level', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 7,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Headline',
                    ],
                ],
            ],
        ],
    ];

    $html = '<h1>Example Headline</h1>';

    expect((new Editor)->setContent($document)->getHTML())->toEqual($html);
});

test('depending on the configuration heading levels are allowed', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 3,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Headline',
                    ],
                ],
            ],
        ],
    ];

    $html = '<h3>Example Headline</h3>';

    expect((new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Heading(['levels' => [1, 2, 3]]),
        ],
    ]))->setContent($document)->getHTML())->toEqual($html);
});

test('depending on the configuration heading levels are transformed', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 4,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Headline',
                    ],
                ],
            ],
        ],
    ];

    $html = '<h1>Example Headline</h1>';

    expect((new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Heading(['levels' => [1, 2, 3]]),
        ],
    ]))->setContent($document)->getHTML())->toEqual($html);
});
