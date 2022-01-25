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

test('forbidden heading levels are ignored', function () {
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
