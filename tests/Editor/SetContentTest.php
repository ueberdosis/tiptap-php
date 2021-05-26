<?php

namespace Tiptap\Editor\Tests;

use PHPUnit\Framework\TestCase;
use Tiptap\Editor;

class SetContentTest extends TestCase
{
    /** @test */
    public function json_strings_are_detected()
    {
        $output = (new Editor)->setContent('{
            "type": "doc",
            "content": [
                {
                    "type": "paragraph",
                    "content": [
                        {
                            "type": "text",
                            "text": "Example Text"
                        }
                    ]
                }
            ]
        }')->getDocument();

        $this->assertEquals(json_decode(json_encode([
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
        ])), $output);
    }


    /** @test */
    public function arrays_are_detected()
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

        $output = (new Editor)->setContent($input)->getDocument();

        $this->assertEquals(json_decode(json_encode($input)), $output);
    }

    /** @test */
    public function html_is_detected()
    {
        $output = (new Editor)->setContent('<p>Example <strong>Text</strong></p>')->getDocument();

        $this->assertEquals(json_decode(json_encode([
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Text',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ])), $output);
    }
}
