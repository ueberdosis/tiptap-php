<?php

use Tiptap\Editor;

test('json strings are detected', function () {
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

    $json = [
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

    expect($output)->toEqual($json);
});


test('arrays are detected', function () {
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

    $output = (new Editor)
        ->setContent($input)
        ->getDocument();

    expect($output)->toEqual($input);
});


test('html is detected', function () {
    $output = (new Editor)
        ->setContent('<p>Example <strong>Text</strong></p>')
        ->getDocument();

    $json = [
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
    ];

    expect($output)->toEqual($json);
});
