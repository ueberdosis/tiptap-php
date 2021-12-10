<?php

namespace Tiptap\Tests\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\HTMLOutput\TestCase;

class OrderedListTest extends TestCase
{
    /** @test */
    public function orderedList_node_gets_rendered_correctly()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'orderedList',
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'first list item',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $html = '<ol><li>first list item</li></ol>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }

    /** @test */
    public function orderedList_has_offset()
    {
        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'orderedList',
                    'attrs' => [
                        'order' => 3,
                    ],
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'text',
                                    'text' => 'first list item',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $html = '<ol start="3"><li>first list item</li></ol>';

        $this->assertEquals($html, (new Editor)->setContent($document)->getHTML());
    }
}
