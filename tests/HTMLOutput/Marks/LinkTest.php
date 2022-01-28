<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

test('link_mark_gets_rendered_correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Link',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://tiptap.dev',
                        ],
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<a href="https://tiptap.dev">Example Link</a>';

    expect($output)->toEqual($html);
});

test('link_mark_has_support_for_rel()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Link',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://tiptap.dev',
                            'rel' => 'noopener',
                        ],
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<a href="https://tiptap.dev" rel="noopener">Example Link</a>';

    expect($output)->toEqual($html);
});

test('link_mark_has_support_for_target()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'text' => 'Example Link',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://tiptap.dev',
                            'target' => '_blank',
                        ],
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<a href="https://tiptap.dev" target="_blank">Example Link</a>';

    expect($output)->toEqual($html);
});

test('link_with_marks_generates_clean_output()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://example.com',
                        ],
                    ],
                ],
                'text' => 'Example ',
            ],
            [
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://example.com',
                        ],
                    ],
                    [
                        'type' => 'bold',
                    ],
                ],
                'text' => 'Link',
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<a href="https://example.com">Example <strong>Link</strong></a>';

    expect($output)->toEqual($html);
});

test('link_with_marks_inside_node_generates_clean_output()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'link',
                                'attrs' => [
                                    'href' => 'https://example.com',
                                ],
                            ],
                        ],
                        'text' => 'Example ',
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'link',
                                'attrs' => [
                                    'href' => 'https://example.com',
                                ],
                            ],
                            [
                                'type' => 'bold',
                            ],
                        ],
                        'text' => 'Link',
                    ],
                ],
            ],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    $html = '<p><a href="https://example.com">Example <strong>Link</strong></a></p>';

    expect($output)->toEqual($html);
});
