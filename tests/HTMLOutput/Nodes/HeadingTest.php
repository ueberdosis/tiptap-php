<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class HeadingTest extends TestCase
{
    /** @test */
    public function heading_node_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'heading',
                    'attrs' => [
                        'level' => 2,
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Headline',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<h2>Example Headline</h2>';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
