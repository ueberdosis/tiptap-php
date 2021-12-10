<?php

namespace Tiptap\Tests\Editor;

use Tiptap\Editor;
use PHPUnit\Framework\TestCase;

class GetHTMLTest extends TestCase
{
    /** @test */
    public function get_html_outputs_html()
    {
        $input = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $output = (new Editor)->setContent($input)->getHTML();

        $this->assertEquals('<p>Example Text</p>', $output);
    }
}
