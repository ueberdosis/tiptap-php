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

    $html = 'Example Text';

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual($html);
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

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual('Example Text');
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

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual('Äffchen');
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

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual('&quot;Example Text&quot;');
});
