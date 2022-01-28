<?php


use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Subscript;

test('subscript_gets_rendered_correctly', function () {
    $html = '<p><sub>Example Text</sub></p>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Subscript,
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
                                'type' => 'subscript',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
