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

    expect($sanitizedDocument)->toEqual((new Editor)->setContent($document)->getDocument());
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

    expect($sanitizedDocument)->toEqual((new Editor)->sanitize($document));
});

test('unknown html tags are removed', function () {
    $document = '<p>Example Text<script>alert("HACKED");</script></p>';
    $html = '<p>Example Text</p>';

    expect($html)->toEqual((new Editor)->setContent($document)->getHTML());
});

test('unknown html tags are removed with the sanitize method', function () {
    $document = '<p>Example Text<script>alert("HACKED");</script></p>';
    $html = '<p>Example Text</p>';

    expect($html)->toEqual((new Editor)->sanitize($document));
});

test('unknown nodes are removed from the json', function () {
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

    expect($sanitizedDocument)->toEqual((new Editor)->setContent($document)->getJSON());
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

    expect($sanitizedDocument)->toEqual((new Editor)->sanitize($document));
});
