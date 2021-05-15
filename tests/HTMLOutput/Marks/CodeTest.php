<?php

namespace Tiptap\Tests\HTMLOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class CodeTest extends TestCase
{
    /** @test */
    public function code_mark_gets_rendered_correctly()
    {
        $json = [
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

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
