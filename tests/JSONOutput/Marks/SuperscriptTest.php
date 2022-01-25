<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Marks\Superscript;
use Tiptap\Extensions\StarterKit;
use Tiptap\Tests\JSONOutput\TestCase;

class SuperscriptTest extends TestCase
{
    /** @test */
    public function superscript_gets_rendered_correctly()
    {
        $html = '<p><sup>Example Text</sup></p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
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
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Superscript,
            ],
        ]))->setContent($html)->getDocument());
    }
}
