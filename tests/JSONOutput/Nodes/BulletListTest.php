<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Tests\JSONOutput\TestCase;

class BulletListTest extends TestCase
{
    /** @test */
    public function bullet_list_gets_rendered_correctly()
    {
        $html = '<ul><li><p>Example</p></li><li><p>Text</p></li></ul>';

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'bullet_list',
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
    public function bullet_list_item_with_text_only_gets_wrapped_in_paragraph()
    {
        $html = '<ul><li>Example</li><li>Text <em>Test</em></li></ul>';

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'bullet_list',
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
                                            'text' => 'Text ',
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => 'Test',
                                            'marks' => [
                                                [
                                                    'type' => 'italic',
                                                ],
                                            ],
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
    public function list_items_with_space_get_rendered_correctly()
    {
        $html = "<ul><li> </li></ul>";

        $json = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'bullet_list',
                    'content' => [
                        [
                            'type' => 'list_item',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [],
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
