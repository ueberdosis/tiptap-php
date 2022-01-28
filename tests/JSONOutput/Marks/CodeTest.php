<?php

use Tiptap\Editor;

test('code gets rendered correctly', function () {
    $html = '<p><code>Example Text</code></p>';

    $output = (new Editor)->setContent($html)->getDocument();

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
                                'type' => 'code',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
