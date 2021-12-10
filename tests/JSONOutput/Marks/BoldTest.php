<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class BoldTest extends TestCase
{
    /** @test */
    public function b_gets_rendered_correctly()
    {
        $html = '<p><b>Example</b> Text</p>';

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
                                    'type' => 'bold',
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
    public function strong_gets_rendered_correctly()
    {
        $html = '<p><strong>Example</strong> Text</p>';

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
                                    'type' => 'bold',
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
    public function b_with_font_weight_normal_is_ignored()
    {
        $html = '<p><b style="font-weight: normal;">Example</b> Text</p>';

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
    public function span_with_font_weight_bold_is_parsed()
    {
        $html = '<p><span style="font-weight: bold;">Example</span> Text</p>';

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
                                    'type' => 'bold',
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
