<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;
use Tiptap\Nodes\Text;
use Tiptap\Nodes\Image;
use Tiptap\Nodes\Paragraph;

class ImageTest extends TestCase
{
    /** @test */
    public function image_node_gets_rendered_correctly()
    {
        $document = [
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

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new Image,
                new Paragraph,
                new Text,
            ],
        ]))->setContent($document)->getHTML());
    }
}
