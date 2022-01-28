<?php

use Tiptap\Editor;

test('json_output_is_correct()', function () {
    $html = "<p>Example</p>";

    $output = (new Editor)
        ->setContent($html)
        ->getJSON();

    $json = '{"type":"doc","content":[{"type":"paragraph","content":[{"type":"text","text":"Example"}]}]}';

    expect($output)->toEqual($json);
});
