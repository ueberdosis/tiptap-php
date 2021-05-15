<?php

namespace Tiptap\Tests\HTMLOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class UnderlineTest extends TestCase
{
    /** @test */
    public function underline_mark_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'underline',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<u>Example Text</u>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
