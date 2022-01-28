<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;
use Tiptap\Tests\JSONOutput\TestCase;

class LinkTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function link_gets_rendered_correctly()
    {
        $html = '<a href="https://tiptap.dev">Example Link</a>';

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

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }

    /** @test */
    public function link_mark_has_support_for_rel()
    {
        $html = '<a href="https://tiptap.dev" rel="noopener">Example Link</a>';

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

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }

    /** @test */
    public function link_mark_has_support_for_target()
    {
        $html = '<a href="https://tiptap.dev" target="_blank">Example Link</a>';

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

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }
}
