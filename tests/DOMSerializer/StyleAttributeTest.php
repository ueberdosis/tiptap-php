<?php

namespace Tiptap\Tests\DOMSerializer;

use Tiptap\Core\Node;
use Tiptap\Editor;
use Tiptap\Extensions\Color;
use Tiptap\Extensions\FontFamily;
use Tiptap\Extensions\StarterKit;
use Tiptap\Extensions\TextAlign;
use Tiptap\Marks\Highlight;
use Tiptap\Marks\TextStyle;
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

test('invalid style values preserve other attributes and configured styles', function ($value) {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'attrs' => ['textAlign' => $value],
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
                'marks' => [[
                    'type' => 'textStyle',
                    'attrs' => ['color' => $value, 'fontFamily' => 'Arial'],
                ], [
                    'type' => 'highlight',
                    'attrs' => ['color' => $value],
                ]],
            ]],
        ], [
            'type' => 'paragraph',
            'content' => [[
                'type' => 'text',
                'text' => 'Font',
                'marks' => [[
                    'type' => 'textStyle',
                    'attrs' => ['fontFamily' => $value, 'color' => 'red'],
                ]],
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TextStyle(['HTMLAttributes' => ['class' => 'formatted', 'style' => 'padding: 1px; margin: 2px']]),
            new Color(),
            new FontFamily(),
            new TextAlign(['types' => ['paragraph']]),
            new Highlight(['multicolor' => true, 'HTMLAttributes' => ['class' => 'highlight']]),
        ],
    ]))->setContent($document)->getHTML();

    expect($html)->toEqual('<p><span class="formatted" style="padding: 1px; margin: 2px; font-family: Arial;"><mark class="highlight">Example</mark></span></p><p><span class="formatted" style="padding: 1px; margin: 2px; color: red;">Font</span></p>');
})->with([
    'semicolon' => ['red;'],
    'opening brace' => ['red{'],
    'closing brace' => ['red}'],
    'empty' => [''],
    'whitespace' => [" \t\n"],
    'null' => [null],
    'boolean' => [true],
    'number' => [123],
    'array' => [['red']],
    'object' => [(object) ['color' => 'red']],
]);

test('missing style values preserve marks and text', function () {
    $document = [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'content' => [[
                'type' => 'text',
                'text' => 'Example',
                'marks' => [['type' => 'textStyle'], ['type' => 'highlight']],
            ]],
        ]],
    ];

    $html = (new Editor([
        'extensions' => [
            new StarterKit(), new TextStyle(), new Color(), new FontFamily(),
            new TextAlign(['types' => ['paragraph']]), new Highlight(['multicolor' => true]),
        ],
    ]))->setContent($document)->getHTML();

    expect($html)->toEqual('<p><span><mark>Example</mark></span></p>');
});
