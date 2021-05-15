<?php

namespace Tiptap\Tests\JSONOutput;

use Tiptap\Editor;

class EmojiTest extends TestCase
{
    /** @test */
    public function emojis_are_transformed_correctly()
    {
        $html = "<p>🔥</p>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => "🔥",
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
