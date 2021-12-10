<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class CodeBlockTest extends TestCase
{
    /** @test */
    public function codeBlock_gets_rendered_correctly()
    {
        $html = '<pre><code>Example Text</code></pre>';

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

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function codeBlock_with_language_gets_rendered_correctly()
    {
        $html = '<pre><code class="language-css">body { display: none }</code></pre>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'codeBlock',
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
