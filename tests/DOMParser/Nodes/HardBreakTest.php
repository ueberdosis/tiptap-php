<?php

use Tiptap\Editor;

test('break_gets_rendered_correctly', function () {
    $html = '<p>Hard <br />Break</p>';

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Hard ',
                    ],
                    [
                        'type' => 'hardBreak',
                    ],
                    [
                        'type' => 'text',
                        'text' => 'Break',
                    ],
                ],
            ],
        ],
    ]);
});


test('multiple_nodes_get_rendered_correctly', function () {
    $html = '<p>Example</p><p>Text</p>';

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Text',
                    ],
                ],
            ],
        ],
    ]);
});
