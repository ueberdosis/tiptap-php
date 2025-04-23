<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Tests\DOMParser\Nodes\BlockquoteCite;

test('no content node gets rendered correctly', function () {
    $html = '<blockquote><p>Quote</p><cite>Author</cite></blockquote>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new BlockquoteCite,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'blockquoteCite',
                'attrs' => [
                    'quote' => 'Quote',
                    'author' => 'Author',
                ],
            ],
        ],
    ]);
});
