<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class HardBreakNodeTest extends TestCase
{
    /** @test */
    public function self_closing_node_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'some text',
                        ],
                        [
                            'type' => 'hardBreak',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'some more text',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<p>some text<br>some more text</p>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
