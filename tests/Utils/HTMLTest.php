<?php

use Tiptap\Utils\Html;

test('classes are merged properly', function () {
    $attributes = [
        ['class' => 'a'],
        ['class' => 'b'],
    ];

    $result = Html::mergeAttributes(...$attributes);

    expect($result)->toEqual(['class' => 'a b']);
});
