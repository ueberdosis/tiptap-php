<?php

namespace Tiptap\Tests\Editor;

use PHPUnit\Framework\TestCase;
use Tiptap\Editor;

class SanitizeTest extends TestCase
{
    /** @test */
    public function unknown_nodes_are_removed_from_the_document()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $sanitizedDocument = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($sanitizedDocument, (new Editor)->setContent($document)->getDocument());
    }

    /** @test */
    public function unknown_nodes_are_removed_from_the_document_with_the_sanitized_method()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $sanitizedDocument = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($sanitizedDocument, (new Editor)->sanitize($document));
    }


    /** @test */
    public function unknown_html_tags_are_removed()
    {
        $document = '<p>Example Text<script>alert("HACKED");</script></p>';
        $html = '<p>Example Text</p>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function unknown_html_tags_are_removed_with_the_sanitize_method()
    {
        $document = '<p>Example Text<script>alert("HACKED");</script></p>';
        $html = '<p>Example Text</p>';

        $this->assertEquals($html, (new Editor)->sanitize($document));
    }

    /** @test */
    public function unknown_nodes_are_removed_from_the_json()
    {
        $document = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ]);

        $sanitizedDocument = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals($sanitizedDocument, (new Editor)->setContent($document)->getJSON());
    }

    /** @test */
    public function unknown_nodes_are_removed_from_the_json_with_the_sanitized_method()
    {
        $document = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ]);

        $sanitizedDocument = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'foo',
                    'content' => [
                        [
                            'type' => 'foo',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ]);

        $this->assertEquals($sanitizedDocument, (new Editor)->sanitize($document));
    }
}
