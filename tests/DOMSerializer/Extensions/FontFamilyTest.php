<?php

namespace Tiptap\Tests\DOMSerializer\Extensions;

use Tiptap\Editor;
use Tiptap\Extensions\FontFamily;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('font family is rendered correctly', function () {
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
                                    'fontFamily' => 'Helvetica, Arial, sans-serif',
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

    expect($result)->toEqual('<p><span style="font-family: Helvetica, Arial, sans-serif;">custom font text</span></p>');
});
