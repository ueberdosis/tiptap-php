<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class WrongFormatTest extends TestCase
{
    /** @test */
    public function node_content_is_string_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => 'test',
        ];

        $this->assertEmpty((new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function node_content_is_empty_array_gets_rendered_correctly_1()
    {
        $json = [
            'type' => 'doc',
            'content' => [],
        ];

        $this->assertEmpty((new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function node_content_is_empty_array_gets_rendered_correctly_2()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [], [],
            ],
        ];

        $this->assertEmpty((new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function node_content_contains_empty_array_gets_rendered_correctly_3()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [],
                'test',
                [],
                '',
                [],
                [
                    'type' => 'code_block',
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

        $html = '<pre><code>Example Text</code></pre>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function node_content_contains_empty_array_empty_mark_gets_rendered_correctly()
    {
        $json = [
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
                                'href' => 'https://scrumpy.io',
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

        $html = '<a href="https://scrumpy.io">Example Link</a>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
