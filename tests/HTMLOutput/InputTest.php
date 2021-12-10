<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class InputTest extends TestCase
{
    /** @test */
    public function array_gets_rendered_to_html()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                ],
            ],
        ];

        $html = 'Example Text';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }


    /** @test */
    public function json_gets_rendered_to_html()
    {
        $document = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                ],
            ],
        ]);

        $html = 'Example Text';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function encoding_is_correct()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Äffchen',
                ],
            ],
        ];

        $html = 'Äffchen';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function quotes_are_not_escaped()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => '"Example Text"',
                ],
            ],
        ];

        $html = '&quot;Example Text&quot;';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
