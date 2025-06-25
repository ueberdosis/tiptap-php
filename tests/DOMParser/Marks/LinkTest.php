<?php


use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;

test('link gets rendered correctly', function () {
    $html = '<a href="https://tiptap.dev">Example Link</a>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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

test('link_mark_has_support_for_class', function () {
    $html = '<a class="tiptap" href="https://tiptap.dev">Example Link</a>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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
                            'class' => 'tiptap',
                        ],
                    ],
                ],
            ],
        ],
    ]);
});

test('link_mark_has_support_for_target', function () {
    $html = '<a href="https://tiptap.dev" target="_blank">Example Link</a>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Link,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
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

function getValidUrls() {
    return [
        'https://example.com',
        'http://example.com',
        '/same-site/index.html',
        '../relative.html',
        'mailto:info@example.com',
        'ftp://info@example.com',
    ];
}

function getInvalidUrls() {
    // Copied from https://github.com/ueberdosis/tiptap/blob/next/tests/cypress/integration/extensions/link.spec.ts

    return [
        // A standard JavaScript protocol
        "javascript:alert(window.origin)",
    
        // The protocol is not case sensitive
        "jAvAsCrIpT:alert(window.origin)",
    
        // Characters \x01-\x20 are allowed before the protocol
        "\x00javascript:alert(window.origin)",
        "\x01javascript:alert(window.origin)",
        "\x02javascript:alert(window.origin)",
        "\x03javascript:alert(window.origin)",
        "\x04javascript:alert(window.origin)",
        "\x05javascript:alert(window.origin)",
        "\x06javascript:alert(window.origin)",
        "\x07javascript:alert(window.origin)",
        "\x08javascript:alert(window.origin)",
        "\x09javascript:alert(window.origin)",
        "\x0ajavascript:alert(window.origin)",
        "\x0bjavascript:alert(window.origin)",
        "\x0cjavascript:alert(window.origin)",
        "\x0djavascript:alert(window.origin)",
        "\x0ejavascript:alert(window.origin)",
        "\x0fjavascript:alert(window.origin)",
        "\x10javascript:alert(window.origin)",
        "\x11javascript:alert(window.origin)",
        "\x12javascript:alert(window.origin)",
        "\x13javascript:alert(window.origin)",
        "\x14javascript:alert(window.origin)",
        "\x15javascript:alert(window.origin)",
        "\x16javascript:alert(window.origin)",
        "\x17javascript:alert(window.origin)",
        "\x18javascript:alert(window.origin)",
        "\x19javascript:alert(window.origin)",
        "\x1ajavascript:alert(window.origin)",
        "\x1bjavascript:alert(window.origin)",
        "\x1cjavascript:alert(window.origin)",
        "\x1djavascript:alert(window.origin)",
        "\x1ejavascript:alert(window.origin)",
        "\x1fjavascript:alert(window.origin)",
    
        // Characters \x09,\x0a,\x0d are allowed inside the protocol
        "java\x09script:alert(window.origin)",
        "java\x0ascript:alert(window.origin)",
        "java\x0dscript:alert(window.origin)",
    
        // Characters \x09,\x0a,\x0d are allowed after protocol name before the colon
        "javascript\x09:alert(window.origin)",
        "javascript\x0a:alert(window.origin)",
        "javascript\x0d:alert(window.origin)",
    ];
}

function getJsonContent($url) {
    return [ 
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Click me',
                        'marks' => [
                            [
                                'type' => 'link',
                                'attrs' => [
                                    'href' => $url,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
}

function getHtmlContent($url) {
    return '<p><a href="' . $url . '">Click me</a></p>';
}

test('link_mark_does_output_href_tag_for_valid_JSON_schemas', function() {
    foreach (getValidUrls() as $url) {
        $content = getJsonContent($url);

        $editor = (new Editor([
            'content' => $content,
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]));

        $result = $editor->getHTML();
        expect($result)->toContain($url);
    }
});

test('link_mark_does_not_output_href_tag_for_valid_JSON_schemas', function() {
    foreach (getInvalidUrls() as $url) {
        $content = getJsonContent($url);

        $editor = (new Editor([
            'content' => $content,
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]));

        $result = $editor->getHTML();
        expect($result)->not->toContain($url);
    }
});

test('link_mark_does_output_href_tag_for_valid_HTML_schemas', function() {
    foreach (getValidUrls() as $url) {
        $content = getHtmlContent($url);

        $editor = (new Editor([
            'content' => $content,
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]));

        $result = $editor->getHTML();
        expect($result)->toContain($url);
    }
});

test('link_mark_does_not_output_href_tag_for_valid_HTML_schemas', function() {
    foreach (getInvalidUrls() as $url) {
        $content = getHtmlContent($url);

        $editor = (new Editor([
            'content' => $content,
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]));

        $result = $editor->getJson();
        expect($result)->not->toContain($url);
    }
});