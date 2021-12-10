<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class ImageTest extends TestCase
{
    /** @test */
    public function image_gets_rendered_correctly()
    {
        $html = '<img src="https://example.com/eggs.png" alt="The Finished Dish" title="Eggs in a dish" />';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'alt' => 'The Finished Dish',
                        'src' => 'https://example.com/eggs.png',
                        'title' => 'Eggs in a dish',
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function image_gets_rendered_correctly_when_title_is_missing()
    {
        $html = '<img src="https://example.com/eggs.png" alt="The Finished Dish" />';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'alt' => 'The Finished Dish',
                        'src' => 'https://example.com/eggs.png',
                        'title' => null,
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function image_gets_rendered_correctly_when_alt_is_missing()
    {
        $html = '<img src="https://example.com/eggs.png" title="Eggs in a dish" />';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'alt' => null,
                        'src' => 'https://example.com/eggs.png',
                        'title' => 'Eggs in a dish',
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
