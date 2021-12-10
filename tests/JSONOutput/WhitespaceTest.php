<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class WhitespaceTest extends TestCase
{
    /** @test */
    public function whitespace_at_the_beginning_is_stripped()
    {
        $html = "<p>\nExample\n Text</p>";

        $document = [
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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function whitespace_in_codeBlocks_is_ignored()
    {
        $html = "<p>\n" .
                "    Example Text\n" .
                "</p>\n" .
                "<pre><code>\n" .
                "Line of Code\n" .
                "    Line of Code 2\n" .
                "Line of Code</code></pre>";

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
                [
                    'type' => 'codeBlock',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "Line of Code\n    Line of Code 2\nLine of Code",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
