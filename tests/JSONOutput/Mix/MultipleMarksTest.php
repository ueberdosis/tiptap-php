<?php

namespace Tiptap\Tests\JSONOutput\Mix;

use Tiptap\Editor;

class MultipleMarksTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function multiple_marks_get_rendered_correctly()
    {
        $html = '<p><strong><em>Example Text</em></strong></p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Text',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                                [
                                    'type' => 'italic',
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
