<?php

namespace Tiptap\Tests\DOMParser\Extensions;

use Tiptap\Editor;
use Tiptap\Extensions\FontFamily;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('font family is parsed correctly', function () {
    $html = '<p><span style="font-family: Arial;">Arial text</span></p>';

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextStyle(),
                new FontFamily(),
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
                                    'fontFamily' => 'Arial',
                                ],
                            ],
                        ],
                        'text' => 'Arial text',
                    ],
                ],
            ],
        ],
    ]);
});

test('multiple font family values are parsed correctly', function () {
    $html = '<p><span style="font-family: Helvetica Neue, Arial, \'Times New Roman\', &quot;Open Sans&quot;, sans-serif;">Multiple fonts</span></p>';

    $result =
        (new Editor([
            'extensions' => [
                new StarterKit,
                new TextStyle(),
                new FontFamily(),
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
                                    'fontFamily' => 'Helvetica Neue, Arial, \'Times New Roman\', "Open Sans", sans-serif',
                                ],
                            ],
                        ],
                        'text' => 'Complex font stack',
                    ],
                ],
            ],
        ],
    ]);
});

test('font family extension respects the types option', function () {
    $html = '<h1 style="font-family: Times New Roman;">Times New Roman heading</h1>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new FontFamily([
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
                    'fontFamily' => 'Times New Roman',
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Times New Roman heading',
                    ],
                ],
            ],
        ],
    ]);
});
