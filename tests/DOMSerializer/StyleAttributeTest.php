<?php

namespace Tiptap\Tests\DOMSerializer;

use Tiptap\Core\Node;
use Tiptap\Editor;
use Tiptap\Nodes\Document;
use Tiptap\Nodes\Text;
use Tiptap\Utils\HTML;

// No bundled extension declares a literal 'style' attribute, so the style branch of
// mergeAttributes is only reachable through a custom extension like this one.
class StyleAttributeNode extends Node
{
    public static $name = 'styleAttributeNode';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function addAttributes()
    {
        return [
            'style' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'div',
            ],
        ];
    }

    public function renderHTML($node, $HTMLAttributes = [])
    {
        return ['div', HTML::mergeAttributes($this->options['HTMLAttributes'], $HTMLAttributes), 0];
    }
}

function renderStyleAttributeNode($style, array $HTMLAttributes = [])
{
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'styleAttributeNode',
                'attrs' => [
                    'style' => $style,
                ],
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example',
                    ],
                ],
            ],
        ],
    ];

    return (new Editor([
        'extensions' => [
            new Document,
            new Text,
            new StyleAttributeNode(['HTMLAttributes' => $HTMLAttributes]),
        ],
    ]))->setContent($document)->getHTML();
}

test('a style attribute that is a string gets rendered', function () {
    expect(renderStyleAttributeNode('color: red'))->toEqual('<div style="color: red;">Example</div>');
});

test('a style attribute that is an array drops the attribute', function () {
    expect(renderStyleAttributeNode(['a', 'b']))->toEqual('<div>Example</div>');
});

test('a style attribute that is an object drops the attribute', function () {
    expect(renderStyleAttributeNode(['k' => 'v']))->toEqual('<div>Example</div>');
});

test('an unrenderable style attribute keeps a style configured on the extension', function () {
    expect(renderStyleAttributeNode(['a', 'b'], ['style' => 'color: red']))
        ->toEqual('<div style="color: red;">Example</div>');
});
