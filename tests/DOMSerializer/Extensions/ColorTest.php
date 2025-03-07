<?php

use Tiptap\Editor;
use Tiptap\Extensions\Color;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\TextStyle;

test('color is rendered correctly', function () {
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
                                    'color' => 'red',
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

    expect($result)->toEqual('<p><span style="color: red;">red text</span></p>');
});
