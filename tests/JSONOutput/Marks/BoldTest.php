<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class BoldTest extends TestCase
{
    /** @test */
    public function b_and_strong_get_rendered_correctly()
    {
        $html = '<p><strong>Example text using strong</strong> and <b>some example text using b</b></p>';

        $json = [
            'type'    => 'doc',
            'content' => [
                [
                    'type'    => 'paragraph',
                    'content' => [
                        [
                            'type'  => 'text',
                            'text'  => 'Example text using strong',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' and ',
                        ],
                        [
                            'type'  => 'text',
                            'text'  => 'some example text using b',
                            'marks' => [
                                [
                                    'type' => 'bold',
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
