<?php

use Tiptap\Editor;

test('emojis are transformed correctly()', function () {
    $html = "<p>🔥</p>";

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "🔥",
                    ],
                ],
            ],
        ],
    ]);
});

test('extended emojis are transformed correctly()', function () {
    $html = "<p>👩‍👩‍👦</p>";

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "👩‍👩‍👦",
                    ],
                ],
            ],
        ],
    ]);
});

test('umlauts are transformed correctly()', function () {
    $html = "<p>äöüÄÖÜß</p>";

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "äöüÄÖÜß",
                    ],
                ],
            ],
        ],
    ]);
});

test('html entities are transformed correctly()', function () {
    $html = "<p>&lt;</p>";

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "<",
                    ],
                ],
            ],
        ],
    ]);
});
