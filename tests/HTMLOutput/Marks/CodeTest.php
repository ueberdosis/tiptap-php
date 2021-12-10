<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class CodeTest extends TestCase
{
    /** @test */
    public function code_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'code',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<code>Example Text</code>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
