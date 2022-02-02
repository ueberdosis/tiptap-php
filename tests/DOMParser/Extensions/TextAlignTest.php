<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;

test('text align is parsed correctly', function () {
    $html = '<p style="text-align: center;">Example Text</p>';

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextAlign([
                    'types' => ['paragraph'],
                ]),
            ],
        ]))
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'attrs' => [
                    'textAlign' => 'center',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);
});
