<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;

class ItalicTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function i_gets_rendered_correctly()
    {
        $html = '<p><i>Example</i> Text</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example',
                            'marks' => [
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function em_gets_rendered_correctly()
    {
        $html = '<p><em>Example</em> Text</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example',
                            'marks' => [
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function i_with_font_style_normal_is_ignored()
    {
        $html = '<p><i style="font-style: normal;">Example</i> Text</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function span_with_font_style_italic_is_parsed()
    {
        $html = '<p><span style="font-style: italic;">Example</span> Text</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example',
                            'marks' => [
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
