<?php

use Tiptap\Editor;

test('unknown nodes are removed from the document', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $sanitizedDocument = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->setContent($document)->getDocument();

    expect($output)->toEqual($sanitizedDocument);
});


test('unknown nodes are removed from the document with the sanitized method', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $sanitizedDocument = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->sanitize($document);

    expect($output)->toEqual($sanitizedDocument);
});

test('unknown HTML tags are removed', function () {
    $document = '<p>Example Text<script>alert("HACKED");</script></p>';

    $output = (new Editor)->setContent($document)->getHTML();

    expect($output)->toEqual('<p>Example Text</p>');
});

test('unknown HTML tags are removed with the sanitize method', function () {
    $document = '<p>Example Text<script>alert("HACKED");</script></p>';


    $output = (new Editor)->sanitize($document);

    expect($output)->toEqual('<p>Example Text</p>');
});

test('unknown nodes are removed from the JSON', function () {
    $document = json_encode([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);

    $output = (new Editor)
        ->setContent($document)
        ->getJSON();

    $sanitizedDocument = json_encode([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);

    expect($output)->toEqual($sanitizedDocument);
});

test('unknown nodes are removed from the json with the sanitized method', function () {
    $document = json_encode([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);

    $output = (new Editor)->sanitize($document);

    $sanitizedDocument = json_encode([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'foo',
                'content' => [
                    [
                        'type' => 'foo',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);

    expect($output)->toEqual($sanitizedDocument);
});
