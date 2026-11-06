<?php

use Tiptap\Editor;
use Tiptap\Extensions\Color;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('color is rendered correctly', function ($color) {
    $json = [
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
                                    'color' => $color,
                                ],
                            ],
                        ],
                        'text' => 'red text',
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TextStyle(),
            new Color(),
        ],
    ]))
        ->setContent($json)
        ->getHTML();

    expect($result)->toEqual('<p><span style="color: ' . $color . ';">red text</span></p>');
})->with(['red', '#ff0000', 'rgb(255, 0, 0)', 'hsl(0, 100%, 50%)', 'var(--text-color)', ' red ']);

test('invalid color values omit generated attributes and preserve text', function ($format) {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
                'marks' => [[
                    'type' => 'textStyle',
                    'attrs' => ['color' => 'red; position: fixed; inset: 0; z-index: 2147483647'],
                ]],
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [new StarterKit(), new TextStyle(), new Color()],
    ]))->setContent($format === 'json' ? json_encode($document) : $document)->getHTML();

    expect($html)->toEqual('<p><span>Example</span></p>');
})->with(['array', 'json']);
