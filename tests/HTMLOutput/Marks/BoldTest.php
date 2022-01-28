<?php

use Tiptap\Editor;

test('bold mark gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'bold',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->setContent($document)->getHTML();

    $html = '<strong>Example Text</strong>';

    expect($output)->toEqual($html);
});
