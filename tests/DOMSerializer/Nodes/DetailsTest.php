<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Nodes\Details;
use Tiptap\Nodes\DetailsContent;
use Tiptap\Nodes\DetailsSummary;

test('details node gets rendered correctly', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'details',
                'content' => [
                    [
                        'type' => 'detailsSummary',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Summary Text',
                            ],
                        ],
                    ],
                    [
                        'type' => 'detailsContent',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Content Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details,
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<details><summary>Summary Text</summary><div data-type="detailsContent"><p>Content Text</p></div></details>');
});

test('details node with open true renders open attribute when persist is enabled', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'details',
                'attrs' => [
                    'open' => true,
                ],
                'content' => [
                    [
                        'type' => 'detailsSummary',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Summary Text',
                            ],
                        ],
                    ],
                    [
                        'type' => 'detailsContent',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Content Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details(['persist' => true]),
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<details open="open"><summary>Summary Text</summary><div data-type="detailsContent"><p>Content Text</p></div></details>');
});

test('details node with open false does not render open attribute when persist is enabled', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'details',
                'attrs' => [
                    'open' => false,
                ],
                'content' => [
                    [
                        'type' => 'detailsSummary',
                        'content' => [
                            [
                                'type' => 'text',
                                'text' => 'Summary Text',
                            ],
                        ],
                    ],
                    [
                        'type' => 'detailsContent',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Content Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details(['persist' => true]),
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<details><summary>Summary Text</summary><div data-type="detailsContent"><p>Content Text</p></div></details>');
});
