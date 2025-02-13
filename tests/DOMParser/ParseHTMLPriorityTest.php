<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Tests\DOMParser\Nodes\HighPriorityParagraph;

test('priority for parsing HTML', function () {
    $html = '<p>Example</p>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new HighPriorityParagraph,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'highPriorityParagraph',
                'content' => [
                    ['type' => 'text', 'text' => 'Example'],
                ],
            ],
        ],
    ]);
});
