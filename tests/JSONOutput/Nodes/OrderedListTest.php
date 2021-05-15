<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class OrderedListTest extends TestCase
{
    /** @test */
    public function ordered_list_gets_rendered_correctly()
    {
        $html = '<ol><li><p>Example</p></li><li><p>Text</p></li></ol>';

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'ordered_list',
                    'attrs' => [
                        'order' => 1,
                    ],
                    'content' => [
                        [
                            'type' => 'list_item',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'Example',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'list_item',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'Text',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }

    /** @test */
    public function ordered_list_has_correct_offset()
    {
        $html = '<ol start="3"><li><p>Example</p></li><li><p>Text</p></li></ol>';

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'ordered_list',
                    'attrs' => [
                        'order' => 3,
                    ],
                    'content' => [
                        [
                            'type' => 'list_item',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'Example',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'list_item',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'Text',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($json, (new Editor)->setContent($html)->getDocument());
    }
}
