<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class ItalicTest extends TestCase
{
    /** @test */
    public function italic_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'italic',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<em>Example Text</em>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
