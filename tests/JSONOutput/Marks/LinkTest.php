<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class LinkTest extends TestCase
{
    /** @test */
    public function link_gets_rendered_correctly()
    {
        $html = '<a href="https://scrumpy.io">Example Link</a>';

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
                                'href' => 'https://scrumpy.io',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function link_mark_has_support_for_rel()
    {
        $html = '<a href="https://scrumpy.io" rel="noopener">Example Link</a>';

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
                                'href' => 'https://scrumpy.io',
                                'rel' => 'noopener',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function link_mark_has_support_for_target()
    {
        $html = '<a href="https://scrumpy.io" target="_blank">Example Link</a>';

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
                                'href' => 'https://scrumpy.io',
                                'target' => '_blank',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
