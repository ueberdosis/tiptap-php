<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class SpecialCharacterTest extends TestCase
{
    /** @test */
    public function emojis_are_transformed_correctly()
    {
        $html = "<p>🔥</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "🔥",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function extended_emojis_are_transformed_correctly()
    {
        $html = "<p>👩‍👩‍👦</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "👩‍👩‍👦",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function umlauts_are_transformed_correctly()
    {
        $html = "<p>äöüÄÖÜß</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "äöüÄÖÜß",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function html_entities_are_transformed_correctly()
    {
        $html = "<p>&lt;</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "<",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
