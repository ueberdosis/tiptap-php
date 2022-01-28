<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Superscript;

test('superscript_gets_rendered_correctly', function () {
    $html = '<p><sup>Example Text</sup></p>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Superscript,
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
