<?php

namespace Tiptap\Tests\HTMLOutput;

use Tiptap\Editor;

class InputTest extends TestCase
{
    /** @test */
    public function array_gets_rendered_to_html()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                ],
            ],
        ];

        $html = 'Example Text';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }


    /** @test */
    public function json_gets_rendered_to_html()
    {
        $json = json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                ],
            ],
        ]);

        $html = 'Example Text';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function encoding_is_correct()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Äffchen',
                ],
            ],
        ];

        $html = 'Äffchen';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }

    /** @test */
    public function quotes_are_not_escaped()
    {
        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => '"Example Text"',
                ],
            ],
        ];

        $html = '&quot;Example Text&quot;';

        $this->assertEquals($html, (new Editor)->setContent($json)->getHTML());
    }
}
