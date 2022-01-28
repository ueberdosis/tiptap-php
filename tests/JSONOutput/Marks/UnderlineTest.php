<?php


use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Underline;

test('underline_gets_rendered_correctly', function () {
    $html = '<p><u>Example Text</u></p>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Underline,
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
                                'type' => 'underline',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
