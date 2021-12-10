<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class CodeBlockTest extends TestCase
{
    /** @test */
    public function code_block_gets_rendered_correctly()
    {
        $html = '<pre><code>Example Text</code></pre>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'code_block',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example Text',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function code_block_with_language_gets_rendered_correctly()
    {
        $html = '<pre><code class="language-css">body { display: none }</code></pre>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'code_block',
                    'attrs' => [
                        'language' => 'css',
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'body { display: none }',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
