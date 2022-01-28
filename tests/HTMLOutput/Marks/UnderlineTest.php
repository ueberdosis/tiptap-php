<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Underline;

test('underline_mark_gets_rendered_correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'underline',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Underline,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toEqual('<u>Example Text</u>');
});
