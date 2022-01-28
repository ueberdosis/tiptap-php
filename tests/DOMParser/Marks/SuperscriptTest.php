<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Superscript;

test('superscript gets rendered correctly', function () {
    $html = '<p><sup>Example Text</sup></p>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Superscript,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                        'marks' => [
                            [
                                'type' => 'superscript',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
