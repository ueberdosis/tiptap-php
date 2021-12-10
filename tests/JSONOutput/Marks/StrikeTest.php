<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class StrikeTest extends TestCase
{
    /** @test */
    public function strike_and_s_del_get_rendered_correctly()
    {
        $html = '<p><strike>Example text using strike</strike> and <s>example text using s</s> and <del>example text using del</del></p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example text using strike',
                            'marks' => [
                                [
                                    'type' => 'strike',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' and ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'example text using s',
                            'marks' => [
                                [
                                    'type' => 'strike',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ' and ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'example text using del',
                            'marks' => [
                                [
                                    'type' => 'strike',
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
