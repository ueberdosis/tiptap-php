<?php

namespace Tiptap\Tests\DOMSerializer\Extensions;

use Tiptap\Editor;
use Tiptap\Extensions\FontFamily;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('font family is rendered correctly', function ($fontFamily, $escapedFontFamily) {
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
                                    'fontFamily' => $fontFamily,
                                ],
                            ],
                        ],
                        'text' => 'custom font text',
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TextStyle(),
            new FontFamily(),
        ],
    ]))
        ->setContent($json)
        ->getHTML();

    expect($result)->toEqual('<p><span style="font-family: ' . $escapedFontFamily . ';">custom font text</span></p>');
})->with([
    ['Helvetica, Arial, sans-serif', 'Helvetica, Arial, sans-serif'],
    ['"Open Sans", sans-serif', '&quot;Open Sans&quot;, sans-serif'],
    [' Arial ', ' Arial '],
]);

test('invalid font family values omit generated attributes and preserve text', function ($format) {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
                'marks' => [[
                    'type' => 'textStyle',
                    'attrs' => ['fontFamily' => 'red; position: fixed; inset: 0; z-index: 2147483647'],
                ]],
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [new StarterKit(), new TextStyle(), new FontFamily()],
    ]))->setContent($format === 'json' ? json_encode($document) : $document)->getHTML();

    expect($html)->toEqual('<p><span>Example</span></p>');
})->with(['array', 'json']);
