<?php

use Tiptap\Editor;

test('parsing must not fail on number string', function () {
    $html = '1999';

    $result = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => "1999",
                    ],
                ],
            ],
        ],
    ]);
});
