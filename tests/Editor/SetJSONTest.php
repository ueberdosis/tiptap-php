<?php

namespace Tiptap\Editor\Tests;

use PHPUnit\Framework\TestCase;
use Tiptap\Editor;

class SetJSONTest extends TestCase
{
    /** @test */
    public function json_string_is_converted_to_an_array()
    {
        $output = (new Editor)->setJSON('{
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

        $this->assertEquals([
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
        ], $output);
    }

    /** @test */
    public function an_array_is_stored_as_an_array()
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

        $output = (new Editor)->setJSON($input)->getDocument();

        $this->assertEquals($input, $output);
    }
}
