<?php

namespace Tiptap\Tests\HTMLOutput\Marks;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class SubscriptTest extends TestCase
{
    /** @test */
    public function subscript_mark_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'subscript',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<sub>Example Text</sub>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
