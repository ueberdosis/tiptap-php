<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class ParagraphTest extends TestCase
{
    /** @test */
    public function paragraph_node_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Paragraph',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<p>Example Paragraph</p>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
