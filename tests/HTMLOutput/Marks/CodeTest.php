<?php

use Tiptap\Editor;

test('code_mark_gets_rendered_correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'code',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor)->setContent($document)->getHTML();

    $html = '<code>Example Text</code>';

    expect($output)->toEqual($html);
});
