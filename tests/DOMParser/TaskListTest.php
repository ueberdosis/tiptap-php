<?php

use Tiptap\Editor;
use Tiptap\Extensions\StarterKit;
use Tiptap\Nodes\TaskItem;
use Tiptap\Nodes\TaskList;

test('task list gets parsed correctly', function () {
    $html = '<ul data-type="taskList"><li data-type="taskItem"><p>Example Text</p></li></ul>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TaskList(),
            new TaskItem(),
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'taskList',
                'content' => [
                    [
                        'type' => 'taskItem',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'type' => 'text',
                                        'text' => 'Example Text',
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

test('bullet lists are still parsed correctly', function () {
    $html = '<ul><li><p>Example Text</p></li></ul>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TaskList(),
            new TaskItem(),
        ],
    ]))->setContent($html)->getDocument();

    expect($result)->toEqual([
        'type' => 'doc',
        'content' => [
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
                                        'text' => 'Example Text',
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

test('task item checked state is parsed from data-checked', function () {
    $html = '<ul data-type="taskList">' .
        '<li data-type="taskItem" data-checked="true"><p>Done</p></li>' .
        '<li data-type="taskItem" data-checked="false"><p>Todo</p></li>' .
        '<li data-type="taskItem" data-checked><p>Also done</p></li>' .
        '</ul>';

    $result = (new Editor([
        'extensions' => [
            new StarterKit(),
            new TaskList(),
            new TaskItem(),
        ],
    ]))->setContent($html)->getDocument();

    expect($result['content'][0]['content'][0]['attrs']['checked'])->toBeTrue()
        ->and($result['content'][0]['content'][1]['attrs']['checked'])->toBeFalse()
        ->and($result['content'][0]['content'][2]['attrs']['checked'])->toBeTrue();
});
