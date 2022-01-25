<?php

use Tiptap\Editor;

test('json_output_is_correct()', function () {
    $html = "<p>Example</p>";

    $json = '{"type":"doc","content":[{"type":"paragraph","content":[{"type":"text","text":"Example"}]}]}';

    expect($json)->toEqual((new Editor)->setContent($html)->getJSON());
});
