<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;

class HorizontalRuleTest extends \PHPUnit\Framework\TestCase
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
                    'type' => 'horizontalRule',
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
