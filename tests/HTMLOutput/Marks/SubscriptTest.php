<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Subscript;

test('subscript mark gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Text',
                'marks' => [
                    [
                        'type' => 'subscript',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Subscript,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<sub>Example Text</sub>';

    expect($output)->toEqual($html);
});
