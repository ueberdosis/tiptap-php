<?php

namespace Tiptap\Tests\HTMLOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class ImageTest extends TestCase
{
    /** @test */
    public function image_node_gets_rendered_correctly()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'alt' => 'an image',
                        'src' => 'image/source',
                        'title' => 'The image title',
                    ],
                ],
            ],
        ];

        $html = '<img alt="an image" src="image/source" title="The image title">';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
