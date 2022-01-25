<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;
use Tiptap\Tests\HTMLOutput\TestCase;

class LinkTest extends TestCase
{
    /** @test */
    public function link_mark_gets_rendered_correctly()
    {
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

        $html = '<a href="https://tiptap.dev">Example Link</a>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($document)->getHTML());
    }

    /** @test */
    public function link_mark_has_support_for_rel()
    {
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

        $html = '<a rel="noopener" href="https://tiptap.dev">Example Link</a>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($document)->getHTML());
    }

    /** @test */
    public function link_mark_has_support_for_target()
    {
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

        $html = '<a target="_blank" href="https://tiptap.dev">Example Link</a>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($document)->getHTML());
    }

    /** @test */
    public function link_with_marks_generates_clean_output()
    {
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

        $html = '<a href="https://example.com">Example <strong>Link</strong></a>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($document)->getHTML());
    }

    /** @test */
    public function link_with_marks_inside_node_generates_clean_output()
    {
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

        $html = '<p><a href="https://example.com">Example <strong>Link</strong></a></p>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($document)->getHTML());
    }
}
