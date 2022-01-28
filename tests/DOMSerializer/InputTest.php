<?php

use Tiptap\Editor;

test('array gets rendered to html', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
            ],
        ],
    ];

    $result = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('Example Text');
});

test('json gets rendered to html', function () {
    $document = json_encode([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
            ],
        ],
    ]);

    $result = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('Example Text');
});

test('encoding is correct', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Äffchen',
            ],
        ],
    ];

    $result = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('Äffchen');
});

test('quotes are not escaped', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => '"Example Text"',
            ],
        ],
    ];

    $result = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('&quot;Example Text&quot;');
});
