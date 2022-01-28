<?php


use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

test('link_gets_rendered_correctly', function () {
    $html = '<a href="https://tiptap.dev">Example Link</a>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual([
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
    ]);
});

test('link_mark_has_support_for_rel', function () {
    $html = '<a href="https://tiptap.dev" rel="noopener">Example Link</a>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual([
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
    ]);
});

test('link_mark_has_support_for_target', function () {
    $html = '<a href="https://tiptap.dev" target="_blank">Example Link</a>';

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($output)->toEqual([
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
    ]);
});
