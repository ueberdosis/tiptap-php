<?php

use Tiptap\Editor;

test('paragraph node gets rendered correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Paragraph',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual('<p>Example Paragraph</p>');
});
