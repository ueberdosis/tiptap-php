<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Nodes\Details;
use Tiptap\Nodes\DetailsContent;
use Tiptap\Nodes\DetailsSummary;

test('details gets rendered correctly', function () {
    $html = '<details><summary>Summary</summary><div data-type="detailsContent"><p>Content</p></div></details>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details,
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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
                                'text' => 'Summary',
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
                                        'text' => 'Content',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});

test('details open attribute is ignored by default', function () {
    $html = '<details open><summary>Summary</summary><div data-type="detailsContent"><p>Content</p></div></details>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details,
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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
                                'text' => 'Summary',
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
                                        'text' => 'Content',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});

test('details open attribute is parsed when persist is enabled', function () {
    $html = '<details open><summary>Summary</summary><div data-type="detailsContent"><p>Content</p></div></details>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details(['persist' => true]),
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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
                                'text' => 'Summary',
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
                                        'text' => 'Content',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});

test('details without open attribute sets open to false when persist is enabled', function () {
    $html = '<details><summary>Summary</summary><div data-type="detailsContent"><p>Content</p></div></details>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Details(['persist' => true]),
            new DetailsSummary,
            new DetailsContent,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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
                                'text' => 'Summary',
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
                                        'text' => 'Content',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ]);
});
