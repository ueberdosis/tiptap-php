<?php

use Tiptap\Editor;

test('getHTML() outputs HTML', function () {
    $input = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->setContent($input)->getHTML();

    expect('<p>Example Text</p>')->toEqual($output);
});
