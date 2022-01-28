<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class HardBreakTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function break_gets_rendered_correctly()
    {
        $html = '<p>Hard <br />Break</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Hard ',
                        ],
                        [
                            'type' => 'hardBreak',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Break',
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
