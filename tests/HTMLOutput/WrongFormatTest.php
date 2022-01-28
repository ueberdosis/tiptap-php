<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

test('node_content_is_string_gets_rendered_correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => 'test',
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toBeEmpty();
});

test('node_content_is_empty_array_gets_rendered_correctly_1()', function () {
    $document = [
        'type' => 'doc',
        'content' => [],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toBeEmpty();
});

test('node_content_is_empty_array_gets_rendered_correctly_2()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [], [],
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toBeEmpty();
});

test('node_content_contains_empty_array_gets_rendered_correctly_3()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [],
            'test',
            [],
            '',
            [],
            [
                'type' => 'codeBlock',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ],
            ],
            [],
            [],
            [],
            '',
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toEqual('<pre><code>Example Text</code></pre>');
});

test('node_content_contains_empty_array_empty_mark_gets_rendered_correctly()', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [],
            'test',
            [],
            '',
            [],
            [
                'type' => 'text',
                'text' => 'Example Link',
                'marks' => [
                    [],
                    '',
                    'test',
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'https://tiptap.dev',
                        ],
                    ],
                ],
            ],
            [],
            [],
            [],
            '',
        ],
    ];

    $output = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($document)->getHTML();

    expect($output)->toEqual('<a href="https://tiptap.dev">Example Link</a>');
});
