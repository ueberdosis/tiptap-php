<?php

namespace Tiptap\Tests\HTMLOutput\Mix;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class MultipleMarksTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function multiple_marks_get_rendered_correctly()
    {
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

        $html = '<p><strong><em>Example Text</em></strong></p>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
