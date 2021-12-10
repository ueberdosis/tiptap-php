<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class BoldTest extends TestCase
{
    /** @test */
    public function bold_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'bold',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<strong>Example Text</strong>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
