<?php

use Tiptap\Editor;
use Tiptap\Extensions\Color;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('color is parsed correctly', function () {
    $html = '<p><span style="color: red;">red text</span></p>';

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextStyle(),
                new Color(),
            ],
        ]))
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
                        'marks' => [
                            [
                                'type' => 'textStyle',
                                'attrs' => [
                                    'color' => 'red',
                                ],
                            ],
                        ],
                        'text' => 'red text',
                    ],
                ],
            ],
        ],
    ]);
});

test('color extension respects the types option', function () {
    $html = '<h1 style="color: red;">red heading</h1>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new Color([
                'types' => ['heading'],
            ]),
        ],
    ]))
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                    'color' => 'red',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'red heading',
                    ],
                ],
            ],
        ],
    ]);
});
