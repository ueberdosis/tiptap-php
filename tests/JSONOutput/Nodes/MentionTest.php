<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Nodes\Mention;
use Tiptap\Nodes\Paragraph;
use Tiptap\Nodes\Text;

class MentionTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function user_mention_gets_rendered_correctly()
    {
        $html = '<p>Hey <span data-type="mention" data-id="123"></span>, was geht?</p>';

        $document = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'type' => 'text',
                            'text' => 'Hey ',
                        ],
                        [
                            'type' => 'mention',
                            'attrs' => [
                                'id' => 123,
                            ],
                        ],
                        [
                            'type' => 'text',
                            'text' => ', was geht?',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($document, (new Editor([
            'extensions' => [
                new Mention,
                new Paragraph,
                new Text,
            ],
        ]))->setContent($html)->getDocument());
    }
}
