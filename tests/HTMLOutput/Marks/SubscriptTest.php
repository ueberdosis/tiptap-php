<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Subscript;
use Tiptap\Tests\HTMLOutput\TestCase;

class SubscriptTest extends TestCase
{
    /** @test */
    public function subscript_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'subscript',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<sub>Example Text</sub>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Subscript,
            ],
        ]))->setContent($document)->getHTML());
    }
}
