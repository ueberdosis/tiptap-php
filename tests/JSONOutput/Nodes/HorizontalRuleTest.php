<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class HorizontalRuleTest extends TestCase
{
    /** @test */
    public function hr_gets_rendered_correctly()
    {
        $html = '<p>Horizontal</p><hr /><p>Rule</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Horizontal',
                        ],
                    ],
                ],
                [
                    'type' => 'horizontal_rule',
                ],
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Rule',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor)->setContent($html)->getDocument());
    }
}
