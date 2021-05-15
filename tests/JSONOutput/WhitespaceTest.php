<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class WhitespaceTest extends TestCase
{
    /** @test */
    public function whitespace_at_the_beginning_is_stripped()
    {
        $html = "<p>\nExample\n Text</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "Example\nText",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function whitespace_in_code_blocks_is_ignored()
    {
        $html = "<p>\n" .
                "    Example Text\n" .
                "</p>\n" .
                "<pre><code>\n" .
                "Line of Code\n" .
                "    Line of Code 2\n" .
                "Line of Code</code></pre>";

        $json = [
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
                [
                    'type' => 'code_block',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "Line of Code\n    Line of Code 2\nLine of Code",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
