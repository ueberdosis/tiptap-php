<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;

class ParagraphTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function simple_text_gets_rendered_correctly()
    {
        $html = '<p>Example Text</p>';

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
    public function multiple_nodes_get_rendered_correctly()
    {
        $html = '<p>Example</p><p>Text</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example',
                        ],
                    ],
                ],
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
