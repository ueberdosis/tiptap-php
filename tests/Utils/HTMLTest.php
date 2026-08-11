<?php

use Tiptap\Utils\HTML;

test('classes are merged properly', function () {
    $attributes = [
        ['class' => 'a'],
        ['class' => 'b'],
    ];

    $result = HTML::mergeAttributes(...$attributes);

    expect($result)->toEqual(['class' => 'a b']);
});

test('styles are merged properly', function () {
    $attributes = [
        ['style' => 'color: red'],
        ['style' => 'font-weight: bold'],
    ];

    $result = HTML::mergeAttributes(...$attributes);

    expect($result)->toEqual(['style' => 'color: red; font-weight: bold;']);
});

test('renderAttributes keeps strings', function () {
    expect(HTML::renderAttributes(['rel' => 'noopener']))->toEqual(' rel="noopener"');
});

test('renderAttributes keeps integers', function () {
    expect(HTML::renderAttributes(['colspan' => 2]))->toEqual(' colspan="2"');
});

test('renderAttributes keeps floats', function () {
    expect(HTML::renderAttributes(['data-ratio' => 1.5]))->toEqual(' data-ratio="1.5"');
});

test('renderAttributes keeps booleans', function () {
    expect(HTML::renderAttributes(['open' => true, 'hidden' => false]))->toEqual(' open="true" hidden="false"');
});

test('renderAttributes escapes strings', function () {
    expect(HTML::renderAttributes(['title' => '"><script>']))->toEqual(' title="&quot;&gt;&lt;script&gt;"');
});

// Test that values that cannot be rendered will be dropped.
test('renderAttributes drops arrays', function () {
    expect(HTML::renderAttributes(['rel' => ['a', 'b']]))->toEqual('');
});

test('renderAttributes drops only the unrenderable value and keeps the rest', function () {
    $attributes = [
        'target' => '_blank',
        'rel' => ['a', 'b'],
        'href' => 'https://tiptap.dev',
    ];

    expect(HTML::renderAttributes($attributes))->toEqual(' target="_blank" href="https://tiptap.dev"');
});
