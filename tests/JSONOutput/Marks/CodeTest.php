<?php

namespace Tiptap\Tests\JSONOutput\Marks;

use Tiptap\Editor;

class CodeTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function code_gets_rendered_correctly()
    {
        $html = '<p><code>Example Text</code></p>';

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
                                    'type' => 'code',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
