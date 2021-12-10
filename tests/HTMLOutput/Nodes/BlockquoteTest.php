<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class BlockquoteTest extends TestCase
{
    /** @test */
    public function blockquote_node_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'blockquote',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Quote',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<blockquote>Example Quote</blockquote>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
