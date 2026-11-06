<?php


use Tiptap\Editor;

test('strike gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'strike',
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor)
        ->setContent($document)
        ->getHTML();

    expect($result)->toEqual('<s>Example Text</s>');
});
