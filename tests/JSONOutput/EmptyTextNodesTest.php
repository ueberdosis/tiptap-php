<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class EmptyTextNodesTest extends TestCase
{
    /** @test */
    public function output_must_not_have_empty_text_nodes()
    {
        $html = "<em><br />\n</em>";

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'hardBreak',
                    'marks' => [
                        [
                            'type' => 'italic',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
