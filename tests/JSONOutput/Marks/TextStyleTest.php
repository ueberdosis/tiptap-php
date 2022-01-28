<?php

use Tiptap\Editor;

test('span gets rendered correctly', function () {
    $html = '<p><span style="color: red">Example</span> Text</p>';

    $output = (new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Paragraph,
            new \Tiptap\Marks\TextStyle,
            new \Tiptap\Nodes\Text,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual([
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
                                'type' => 'textStyle',
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
    ]);
});

test('span without inline style is ignored', function () {
    $html = '<p><span>Example</span> Text</p>';

    $output = (new Editor([
        'extensions' => [
            new \Tiptap\Nodes\Paragraph,
            new \Tiptap\Marks\TextStyle,
            new \Tiptap\Nodes\Text,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual([
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
    ]);
});
