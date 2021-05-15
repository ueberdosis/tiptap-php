<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class BlockquoteTest extends TestCase
{
    /** @test */
    public function blockquote_gets_rendered_correctly()
    {
        $html = '<blockquote><p>Paragraph</p></blockquote>';

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'blockquote',
                    'content' => [
                        [
                            'type' => 'paragraph',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'Paragraph',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
