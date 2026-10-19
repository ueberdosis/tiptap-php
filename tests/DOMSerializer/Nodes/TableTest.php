<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Nodes\Paragraph;
use Tiptap\Nodes\Table;
use Tiptap\Nodes\TableCell;
use Tiptap\Nodes\TableHeader;
use Tiptap\Nodes\TableRow;
use Tiptap\Nodes\Text;

test('simple table node gets rendered correctly', function () {
    $document = [
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
                        ],
                    ],
                ],
            ],
        ],
    ];

    $result = (new Editor([
        'extensions' => [
            new Table,
            new TableRow,
            new TableCell,
            new TableHeader,
            new Paragraph,
            new Text,
        ],
    ]))->setContent($document)->getHTML();

    expect($result)->toEqual('<table style="min-width: 25px;"><colgroup><col style="min-width: 25px"></colgroup><tbody><tr><th><p>text in header cell</p></th></tr></tbody></table>');
});

test('table node gets rendered correctly', function () {
    $document = [
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
    ];

    $result = (new Editor([
        'extensions' => [
            new Table,
            new TableRow,
            new TableCell,
            new TableHeader,
            new Paragraph,
            new Text,
        ],
    ]))->setContent($document)->getHTML();

    $html =
        '<table style="min-width: 150px;"><colgroup><col style="min-width: 25px"><col style="width: 100px"><col style="min-width: 25px"></colgroup><tbody>' .
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

    expect($result)->toEqual($html);
});

test('table column widths are rendered correctly', function () {
    $html =
        '<table><tbody><tr>' .
            '<th data-colwidth="120"><p>Header</p></th>' .
            '<td colspan="2" data-colwidth="240,360"><p>Cell</p></td>' .
        '</tr></tbody></table>';

    $editor = new Editor([
        'extensions' => [
            new StarterKit,
            new Table,
            new TableRow,
            new TableCell,
            new TableHeader,
        ],
    ]);

    $result = $editor->setContent($html)->getHTML();

    $expected =
        '<table style="width: 720px;">' .
            '<colgroup><col style="width: 120px"><col style="width: 240px"><col style="width: 360px"></colgroup>' .
            '<tbody><tr>' .
                '<th data-colwidth="120"><p>Header</p></th>' .
                '<td colspan="2" data-colwidth="240,360"><p>Cell</p></td>' .
            '</tr></tbody>' .
        '</table>';

    expect($result)->toEqual($expected);
    expect($editor->setContent($result)->getHTML())->toEqual($expected);
});

test('tables without stored widths are rendered correctly', function ($html, $options, $expected) {
    $editor = new Editor([
        'extensions' => [
            new StarterKit,
            new Table($options),
            new TableRow,
            new TableCell,
        ],
    ]);

    $result = $editor->setContent($html)->getHTML();

    expect($result)->toEqual($expected);
    expect($editor->setContent($result)->getHTML())->toEqual($expected);
})->with([
    'default minimum width' => [
        '<table><tr><td><p>A</p></td><td><p>B</p></td><td><p>C</p></td></tr></table>',
        [],
        '<table style="min-width: 75px;"><colgroup><col style="min-width: 25px"><col style="min-width: 25px"><col style="min-width: 25px"></colgroup><tbody><tr><td><p>A</p></td><td><p>B</p></td><td><p>C</p></td></tr></tbody></table>',
    ],
    'zero widths with configured sizing' => [
        '<table><tr><td data-colwidth="0,0" colspan="2"><p>Cell</p></td></tr></table>',
        ['HTMLAttributes' => ['style' => 'min-width: 500px']],
        '<table style="min-width: 500px; min-width: 50px;"><colgroup><col style="min-width: 25px"><col style="min-width: 25px"></colgroup><tbody><tr><td colspan="2" data-colwidth="0,0"><p>Cell</p></td></tr></tbody></table>',
    ],
    'empty' => [
        '<table></table>',
        ['HTMLAttributes' => ['style' => 'min-width: 500px']],
        '<table style="min-width: 500px;"><tbody></tbody></table>',
    ],
]);

test('configured table attributes and minimum width are rendered correctly', function () {
    $result = (new Editor([
        'extensions' => [
            new StarterKit,
            new Table([
                'cellMinWidth' => 50.5,
                'HTMLAttributes' => ['class' => 'custom-table', 'style' => 'color: red'],
            ]),
            new TableRow,
            new TableCell,
        ],
    ]))->setContent('<table><tbody><tr><td data-colwidth="120"><p>Resized</p></td><td><p>Cell</p></td></tr></tbody></table>')->getHTML();

    expect($result)->toEqual('<table class="custom-table" style="color: red; min-width: 170.5px;"><colgroup><col style="width: 120px"><col style="min-width: 50.5px"></colgroup><tbody><tr><td data-colwidth="120"><p>Resized</p></td><td><p>Cell</p></td></tr></tbody></table>');
});

test('table column generation respects colspan bounds', function () {
    $document = [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'table',
                'content' => [
                    [
                        'type' => 'tableRow',
                        'content' => [
                            [
                                'type' => 'tableCell',
                                'attrs' => [
                                    'colspan' => [],
                                    'colwidth' => [120.5],
                                ],
                                'content' => [
                                    [
                                        'type' => 'paragraph',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];

    $editor = new Editor([
        'extensions' => [
            new StarterKit,
            new Table,
            new TableRow,
            new TableCell,
        ],
    ]);

    $result = $editor->setContent($document)->getHTML();

    expect($result)->toEqual('<table style="width: 120.5px;"><colgroup><col style="width: 120.5px"></colgroup><tbody><tr><td data-colwidth="120.5"><p></p></td></tr></tbody></table>');

    $document['content'][0]['content'][0]['content'][0]['attrs']['colspan'] = 1000000;

    expect(substr_count($editor->setContent($document)->getHTML(), '<col '))->toEqual(1000);
});
