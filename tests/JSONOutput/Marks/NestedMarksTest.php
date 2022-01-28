<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class NestedMarksTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function nested_marks_get_rendered_correctly()
    {
        $html = '<strong>only bold <em>bold and italic</em> only bold</strong>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'only bold ',
                    'marks' => [
                        [
                            'type' => 'bold',
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'text' => 'bold and italic',
                    'marks' => [
                        [
                            'type' => 'bold',
                        ],
                        [
                            'type' => 'italic',
                        ],
                    ],
                ],
                [
                    'type' => 'text',
                    'text' => ' only bold',
                    'marks' => [
                        [
                            'type' => 'bold',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
