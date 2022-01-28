<?php


use Tiptap\Editor;

test('i gets rendered correctly', function () {
    $html = '<p><i>Example</i> Text</p>';

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'italic',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ]);
});

test('em gets rendered correctly', function () {
    $html = '<p><em>Example</em> Text</p>';

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'italic',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ]);
});

test('i with font style normal is ignored', function () {
    $html = '<p><i style="font-style: normal;">Example</i> Text</p>';

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
        ],
    ]);
});

test('span with font style italic is parsed', function () {
    $html = '<p><span style="font-style: italic;">Example</span> Text</p>';

    $output = (new Editor)
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                        'marks' => [
                            [
                                'type' => 'italic',
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' Text',
                    ],
                ],
            ],
        ],
    ]);
});
