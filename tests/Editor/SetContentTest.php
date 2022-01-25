<?php

use Tiptap\Editor;

test('json_strings_are_detected()', function () {
    $output = (new Editor)->setContent('{
        "type": "doc",
        "content": [
            {
                "type": "paragraph",
                "content": [
                    {
                        "type": "text",
                        "text": "Example Text"
                    }
                ]
            }
        ]
    }')->getDocument();

    expect([
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
    ])->toEqual($output);
});


test('arrays_are_detected()', function () {
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

    $output = (new Editor)->setContent($input)->getDocument();

    expect($input)->toEqual($output);
});


test('html_is_detected()', function () {
    $output = (new Editor)->setContent('<p>Example <strong>Text</strong></p>')->getDocument();

    expect([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example ',
                    ],
                    [
                        'type' => 'text',
                        'text' => 'Text',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ])->toEqual($output);
});
