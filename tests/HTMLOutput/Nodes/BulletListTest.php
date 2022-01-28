<?php

use Tiptap\Editor;

test('bulletList node gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'bulletList',
                'content' => [
                    [
                        'type' => 'listItem',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'first list item',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($output)->toEqual('<ul><li>first list item</li></ul>');
});
