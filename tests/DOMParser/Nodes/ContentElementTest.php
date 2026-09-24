<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Tests\DOMParser\Nodes\ContentElement;

test('node with contentElement gets rendered correctly', function () {
    $html = '<div class="contentElement"><span>no content</span><span>content</span></div>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new ContentElement,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'contentElement',
                'content' => [
                    ['type' => 'text', 'text' => 'content'],
                ],
            ],
        ],
    ]);
});
