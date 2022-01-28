<?php

use Tiptap\Editor;

test('emojis are transformed correctly', function () {
    $html = "<p>🔥</p>";

    $output = (new Editor)->setContent($html)->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "🔥",
                    ],
                ],
            ],
        ],
    ]);
});
