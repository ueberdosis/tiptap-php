<?php

use Tiptap\Editor;

test('mark gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => 'red',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new \Tiptap\Extensions\StarterKit,
            new \Tiptap\Marks\Highlight,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<p><mark data-color="red" style="background-color: red;">Example</mark> Text</p>');
});
