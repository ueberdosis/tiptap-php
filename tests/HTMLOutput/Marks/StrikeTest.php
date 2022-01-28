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

    $output = (new Editor)->setContent($document)->getHTML();

    $html = '<strike>Example Text</strike>';

    expect($output)->toEqual($html);
});
