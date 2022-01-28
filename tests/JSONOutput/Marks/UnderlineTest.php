<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Underline;

class UnderlineTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function underline_gets_rendered_correctly()
    {
        $html = '<p><u>Example Text</u></p>';

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
                                    'type' => 'underline',
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
                new Underline,
            ],
        ]))->setContent($html)->getDocument());
    }
}
