<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class SpecialCharacterTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function emojis_are_transformed_correctly()
    {
        $html = "<p>🔥</p>";

        $document = [
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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function extended_emojis_are_transformed_correctly()
    {
        $html = "<p>👩‍👩‍👦</p>";

        $document = [
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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function umlauts_are_transformed_correctly()
    {
        $html = "<p>äöüÄÖÜß</p>";

        $document = [
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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function html_entities_are_transformed_correctly()
    {
        $html = "<p>&lt;</p>";

        $document = [
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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
