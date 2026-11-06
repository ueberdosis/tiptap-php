<?php

namespace Tiptap\Tests\JSONOutput\Nodes;

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Nodes\Table;
use Tiptap\Nodes\TableCell;
use Tiptap\Nodes\TableHeader;
use Tiptap\Nodes\TableRow;

test('table gets rendered correctly', function () {
    $html =
        '<table><tbody>' .
            '<tr>' .
                '<th><p>text in header cell</p></th>' .
                '<th colspan="2" data-colwidth="100,0"><p>text in header cell with colspan 2</p></th>' .
            '</tr>' .
            '<tr>' .
                '<td rowspan="2"><p>paragraph 1 in cell with rowspan 2</p><p>paragraph 2 in cell with rowspan 2</p></td>' .
                '<td><p>foo</p></td>' .
                '<td><p>bar</p></td>' .
            '</tr>' .
            '<tr>' .
                '<td><p>foo</p></td>' .
                '<td><p>bar</p></td>' .
            '</tr>' .
        '</tbody></table>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Table,
            new TableRow,
            new TableCell,
            new TableHeader,
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'table',
                'content' => [
                    [
                        'type' => 'tableRow',
                        'content' => [
                            [
                                'type' => 'tableHeader',
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'text in header cell',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'type' => 'tableHeader',
                                'attrs' => [
                                    'colspan' => 2,
                                    'colwidth' => [
                                        100,
                                        0,
                                    ],
                                ],
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'text in header cell with colspan 2',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'tableRow',
                        'content' => [
                            [
                                'type' => 'tableCell',
                                'attrs' => [
                                    'rowspan' => 2,
                                ],
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'paragraph 1 in cell with rowspan 2',
                                            ],
                                        ],
                                    ],
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'paragraph 2 in cell with rowspan 2',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'type' => 'tableCell',
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'foo',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'type' => 'tableCell',
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'bar',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'tableRow',
                        'content' => [
                            [
                                'type' => 'tableCell',
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'foo',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                            [
                                'type' => 'tableCell',
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                        'content' => [
                                            [
                                                'type' => 'text',
                                                'text' => 'bar',
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
    ]);
});

function parseTableCells(string $row): array
{
    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Table,
            new TableRow,
            new TableCell,
            new TableHeader,
        ],
    ]))->setContent('<table><tbody><tr>' . $row . '</tr></tbody></table>')->getDocument();

    return array_map(
        fn ($cell) => $cell['content'] ?? null,
        $result['content'][0]['content'][0]['content']
    );
}

test('inline content of table cells and headers is wrapped in a paragraph', function () {
    expect(parseTableCells('<th>header</th><td>cell <strong>bold</strong><br>next line</td>'))->toEqual([
        [
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'header'],
                ],
            ],
        ],
        [
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'cell '],
                    ['type' => 'text', 'text' => 'bold', 'marks' => [['type' => 'bold']]],
                    ['type' => 'hardBreak'],
                    ['type' => 'text', 'text' => 'next line'],
                ],
            ],
        ],
    ]);
});

test('inline content between blocks in a table cell is wrapped in separate paragraphs', function () {
    expect(parseTableCells('<td>before<p>paragraph</p>after</td>'))->toEqual([
        [
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'before'],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'paragraph'],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'after'],
                ],
            ],
        ],
    ]);
});

test('block content of table cells is not wrapped in a paragraph', function () {
    $html = "<td>\n    <p>one</p>\n    <p>two</p>\n</td>"
        . '<td><ul><li><p>item</p></li></ul></td>'
        . '<td></td>';

    expect(parseTableCells($html))->toEqual([
        [
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'one'],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    ['type' => 'text', 'text' => 'two'],
                ],
            ],
        ],
        [
            [
                'type' => 'bulletList',
                'content' => [
                    [
                        'type' => 'listItem',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    ['type' => 'text', 'text' => 'item'],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        null,
    ]);
});
