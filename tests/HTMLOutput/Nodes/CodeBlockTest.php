<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class CodeBlockTest extends TestCase
{
    /** @test */
    public function codeBlock_node_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'codeBlock',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $html = '<pre><code>Example Text</code></pre>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
