<?php

use Tiptap\Editor;

test('plain text is wrapped in a paragraph', function () {
    $result = (new Editor)
        ->setContent('Hello world')
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hello world',
                    ],
                ],
            ],
        ],
    ]);
});

test('plain text with special characters is wrapped in a paragraph', function () {
    $result = (new Editor)
        ->setContent('Hello & goodbye < world')
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hello & goodbye < world',
                    ],
                ],
            ],
        ],
    ]);
});

test('html input with tags is not double-wrapped', function () {
    $result = (new Editor)
        ->setContent('<p>Hello world</p>')
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hello world',
                    ],
                ],
            ],
        ],
    ]);
});
