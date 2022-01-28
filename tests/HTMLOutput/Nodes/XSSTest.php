<?php

use Tiptap\Editor;

test('text should not get rendered as html', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => '<script>alert(1)</script>',
            ],
        ],
    ];

    $output = (new Editor)->setContent($document)->getHTML();

    expect($output)->toEqual('&lt;script&gt;alert(1)&lt;/script&gt;');
});
