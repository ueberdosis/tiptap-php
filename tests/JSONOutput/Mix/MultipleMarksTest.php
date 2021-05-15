<?php

namespace Tiptap\Tests\JSONOutput\Mix;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class MultipleMarksTest extends TestCase
{
    /** @test */
    public function multiple_marks_get_rendered_correctly()
    {
        $html = '<p><strong><em>Example Text</em></strong></p>';

        $json = [
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

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
