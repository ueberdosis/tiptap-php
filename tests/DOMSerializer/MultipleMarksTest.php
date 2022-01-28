<?php

namespace Tiptap\Tests\HTMLOutput\Mix;

use Tiptap\Editor;

test('multiple marks get rendered correctly', function () {
    $document = [
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
                                'type' => 'bold',
                            ],
                            [
                                'type' => 'italic',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor)->setContent($document)->getHTML();

    expect($result)->toEqual('<p><strong><em>Example Text</em></strong></p>');
});
