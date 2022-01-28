<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;

class CustomMark extends \Tiptap\Core\Mark
{
    public static $name = 'custom';

    public function parseHTML()
    {
        return [
            [
                'tag' => 'span',
            ]
        ];
    }

    public static function addAttributes()
    {
        return [
            'foo' => [
                'parseHTML' => fn ($DOMNode) => $DOMNode->getAttribute('data-foo'),
            ],
            'bar' => [],
        ];
    }
}

test('b and strong get rendered correctly', function () {
    $html = '<p><span data-foo="bla bla" bar="nanana">Example text inside custom mark</span> and some more text.</p>';

    $output = (new Editor([
            'extensions' => [
                new StarterKit,
                new CustomMark,
            ],
        ]))
        ->setContent($html)
        ->getDocument();

    expect($output)->toEqual([
        'type'    => 'doc',
        'content' => [
            [
                'type'    => 'paragraph',
                'content' => [
                    [
                        'type'  => 'text',
                        'text'  => 'Example text inside custom mark',
                        'marks' => [
                            [
                                'type' => 'custom',
                                'attrs' => [
                                    'foo' => 'bla bla',
                                    'bar' => 'nanana',
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'text',
                        'text' => ' and some more text.',
                    ],
                ],
            ],
        ],
    ]);
});
