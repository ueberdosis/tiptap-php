<?php

namespace Tiptap\Tests\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Superscript;
use Tiptap\Tests\HTMLOutput\TestCase;

class SuperscriptTest extends TestCase
{
    /** @test */
    public function superscript_mark_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'text',
                    'text' => 'Example Text',
                    'marks' => [
                        [
                            'type' => 'superscript',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<sup>Example Text</sup>';

        $this->assertEquals($html, (new Editor([
            'extensions' => [
                new StarterKit,
                new Superscript,
            ],
        ]))->setContent($document)->getHTML());
    }
}
