<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Subscript;
use Tiptap\Tests\JSONOutput\TestCase;

class SubscriptTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function subscript_gets_rendered_correctly()
    {
        $html = '<p><sub>Example Text</sub></p>';

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
                                    'type' => 'subscript',
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
                new Subscript,
            ],
        ]))->setContent($html)->getDocument());
    }
}
