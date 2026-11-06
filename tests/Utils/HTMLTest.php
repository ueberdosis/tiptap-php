<?php

use Tiptap\Utils\HTML;

class StringableClass
{
    public function __toString(): string
    {
        return 'from-toString';
    }
}

class EmptyStringableClass
{
    public function __toString(): string
    {
        return '';
    }
}

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

// mergeAttributes concatenates 'class' and 'style' instead of copying them, so a value
// that is not a string has to be dropped before it reaches the concatenation.
test('mergeAttributes drops a class that is an object', function () {
    $result = HTML::mergeAttributes(['class' => 'link'], ['class' => json_decode('{"k":"v"}')]);

    expect($result)->toEqual(['class' => 'link']);
});

test('mergeAttributes drops a class that is an array', function () {
    $result = HTML::mergeAttributes(['class' => 'link'], ['class' => ['a', 'b']]);

    expect($result)->toEqual(['class' => 'link']);
});

test('mergeAttributes drops a class that is an object and keeps no class at all', function () {
    $result = HTML::mergeAttributes([], ['class' => json_decode('{"k":"v"}')]);

    expect($result)->toEqual([]);
});

test('mergeAttributes drops an already merged class that is an array', function () {
    $result = HTML::mergeAttributes(['class' => ['a', 'b']], ['class' => 'external']);

    expect($result)->toEqual(['class' => 'external']);
});

test('mergeAttributes drops an already merged class that is an object', function () {
    $result = HTML::mergeAttributes(['class' => json_decode('{"k":"v"}')], ['class' => 'external']);

    expect($result)->toEqual(['class' => 'external']);
});

test('mergeAttributes never renders a class when every value is unrenderable', function () {
    $result = HTML::mergeAttributes(['class' => ['a']], ['class' => ['b']]);

    expect(HTML::renderAttributes($result))->toEqual('');
});

test('mergeAttributes drops a style that is an array', function () {
    $result = HTML::mergeAttributes(['style' => 'color: red'], ['style' => ['a', 'b']]);

    expect($result)->toEqual(['style' => 'color: red;']);
});

test('mergeAttributes drops a style that is an object', function () {
    $result = HTML::mergeAttributes(['style' => 'color: red'], ['style' => json_decode('{"k":"v"}')]);

    expect($result)->toEqual(['style' => 'color: red;']);
});

test('mergeAttributes drops a style that is an object and keeps no style at all', function () {
    $result = HTML::mergeAttributes([], ['style' => json_decode('{"k":"v"}')]);

    expect($result)->toEqual([]);
});

test('mergeAttributes drops an already merged style that is an array', function () {
    $result = HTML::mergeAttributes(['style' => ['a', 'b']], ['style' => 'font-weight: bold']);

    expect($result)->toEqual(['style' => 'font-weight: bold;']);
});

test('mergeAttributes drops a style that is null instead of leaving an empty declaration', function () {
    $result = HTML::mergeAttributes(['style' => 'color: red'], ['style' => null]);

    expect($result)->toEqual(['style' => 'color: red;']);
});

// mergeAttributes has no type declarations, so callers can hand it anything.
test('mergeAttributes accepts an object as its first argument', function () {
    $result = HTML::mergeAttributes(json_decode('{"class":"a"}'), ['class' => 'b']);

    expect($result)->toEqual(['class' => 'a b']);
});

test('mergeAttributes ignores an argument that is a string', function () {
    $result = HTML::mergeAttributes(['class' => 'a'], 'oops');

    expect($result)->toEqual(['class' => 'a']);
});

test('mergeAttributes ignores an argument that is an integer', function () {
    $result = HTML::mergeAttributes(['class' => 'a'], 5);

    expect($result)->toEqual(['class' => 'a']);
});

test('mergeAttributes ignores an argument that is null', function () {
    $result = HTML::mergeAttributes(['class' => 'a'], null);

    expect($result)->toEqual(['class' => 'a']);
});

test('mergeAttributes returns an array when called without arguments', function () {
    expect(HTML::mergeAttributes())->toEqual([]);
});

// Guards against the fix over-reaching: every other key is copied, not concatenated,
// and null is how callers remove an attribute again.
test('mergeAttributes keeps a null value for keys other than class and style', function () {
    $result = HTML::mergeAttributes(['href' => 'https://tiptap.dev'], ['target' => null]);

    expect($result)->toEqual(['href' => 'https://tiptap.dev', 'target' => null]);
});

test('mergeAttributes keeps an unrenderable value for keys other than class and style', function () {
    $result = HTML::mergeAttributes(['href' => 'https://tiptap.dev'], ['rel' => ['a', 'b']]);

    expect($result)->toEqual(['href' => 'https://tiptap.dev', 'rel' => ['a', 'b']]);
});

test('mergeAttributes lets an unrenderable value overwrite an already merged one', function () {
    $result = HTML::mergeAttributes(['rel' => 'noopener'], ['rel' => ['a', 'b']]);

    expect($result)->toEqual(['rel' => ['a', 'b']]);
});

test('mergeAttributes keeps a class that is null', function () {
    $result = HTML::mergeAttributes(['class' => 'link'], ['class' => null]);

    expect($result)->toEqual(['class' => 'link']);
});

test('mergeAttributes keeps a class that is a scalar but not a string', function () {
    $result = HTML::mergeAttributes(['class' => 'link'], ['class' => 5]);

    expect($result)->toEqual(['class' => 'link 5']);
});

test('mergeAttributes keeps a class that can be cast to a string', function () {
    $result = HTML::mergeAttributes(['class' => 'link'], ['class' => new StringableClass]);

    expect($result)->toEqual(['class' => 'link from-toString']);
});

test('mergeAttributes keeps a value that can be cast to a string', function () {
    $result = HTML::mergeAttributes([], ['title' => new StringableClass]);

    expect(HTML::renderAttributes($result))->toEqual(' title="from-toString"');
});

test('renderAttributes keeps values that can be cast to a string', function () {
    expect(HTML::renderAttributes(['title' => new StringableClass]))->toEqual(' title="from-toString"');
});

test('renderAttributes drops values that cast to an empty string', function () {
    expect(HTML::renderAttributes(['title' => new EmptyStringableClass]))->toEqual('');
});
