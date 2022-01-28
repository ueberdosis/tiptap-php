<?php

use Tiptap\Editor;
use Tiptap\Nodes\Mention;
use Tiptap\Extensions\StarterKit;

test('user mention gets rendered correctly', function () {
    $html = '<p>Hey <span data-type="mention" data-id="123"></span>, was geht?</p>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Mention,
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
                        'text' => 'Hey ',
                    ],
                    [
                        'type' => 'mention',
                        'attrs' => [
                            'id' => 123,
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ', was geht?',
                    ],
                ],
            ],
        ],
    ]);
});
