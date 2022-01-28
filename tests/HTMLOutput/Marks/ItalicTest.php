<?php

use Tiptap\Editor;

test('italic_mark_gets_rendered_correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'italic',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->setContent($document)->getHTML();

    $html = '<em>Example Text</em>';

    expect($output)->toEqual($html);
});
