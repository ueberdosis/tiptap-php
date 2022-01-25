<?php

namespace Tiptap\Tests\JSONOutput\Mix;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Marks\Link;
use Tiptap\Tests\JSONOutput\TestCase;

class MarksInNodesTest extends TestCase
{
    /** @test */
    public function paragraph_with_marks_gets_rendered_correctly()
    {
        $html = "<p>Example <strong><em>Text</em></strong>.</p>";

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Example ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Text',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => '.',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }

    /** @test */
    public function complex_markup_gets_rendered_correctly()
    {
        $html = '
            <h1>Headline 1</h1>
            <p>
                Some text. <strong>Bold Text</strong>. <em>Italic Text</em>. <strong><em>Bold and italic Text</em></strong>. Here is a <a href="https://tiptap.dev">Link</a>.
            </p>
        ';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'heading',
                    'attrs' => [
                        'level' => '1',
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Headline 1',
                        ],
                    ],
                ],
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Some text. ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Bold Text',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => '. ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Italic Text',
                            'marks' => [
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => '. ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Bold and italic Text',
                            'marks' => [
                                [
                                    'type' => 'bold',
                                ],
                                [
                                    'type' => 'italic',
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => '. Here is a ',
                        ],
                        [
                            'type' => 'text',
                            'text' => 'Link',
                            'marks' => [
                                [
                                    'type' => 'link',
                                    'attrs' => [
                                        'href' => 'https://tiptap.dev',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => '.',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }

    /** @test */
    public function multiple_lists_gets_rendered_correctly()
    {
        $html = '
            <h2>Headline 2</h2>
            <ol>
                <li>ordered list item</li>
                <li>ordered list item</li>
                <li>ordered list item</li>
            </ol>
            <ul>
                <li>unordered list item</li>
                <li>unordered list item with <a href="https://tiptap.dev"><strong>link</strong></a></li>
                <li>unordered list item</li>
            </ul>
            <p>Some Text.</p>
        ';

        $document = [
            'type' => 'doc',
            'content' =>
            [
                [
                    'type' => 'heading',
                    'attrs' => [
                        'level' => '2',
                    ],
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Headline 2',
                        ],
                    ],
                ],
                [
                    'type' => 'orderedList',
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'ordered list item',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'ordered list item',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'ordered list item',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'bulletList',
                    'content' => [
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'unordered list item',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'unordered list item with ',
                                        ],
                                        [
                                            'type' => 'text',
                                            'text' => 'link',
                                            'marks' => [
                                                [
                                                    'type' => 'link',
                                                    'attrs' => [
                                                        'href' => 'https://tiptap.dev',
                                                    ],
                                                ],
                                                [
                                                    'type' => 'bold',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'listItem',
                            'content' => [
                                [
                                    'type' => 'paragraph',
                                    'content' => [
                                        [
                                            'type' => 'text',
                                            'text' => 'unordered list item',
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Some Text.',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new StarterKit,
                new Link,
            ],
        ]))->setContent($html)->getDocument());
    }
}
