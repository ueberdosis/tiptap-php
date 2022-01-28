<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class KeepContentOfUnknownTagsTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function keeps_content_of_unknown_tags()
    {
        $html = "<p>Example <x-unknown-tag>Text</x-unknown-tag></p>";

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "Example Text",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function keeps_content_of_unknown_tags_even_if_it_has_known_tags()
    {
        $html = "<p>Example <x-unknown-tag><b>Text</b></x-unknown-tag></p>";

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "Example ",
                        ],
                        [
                            'type' => 'text',
                            'text' => "Text",
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
