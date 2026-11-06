<?php

use Tiptap\Utils\InlineStyle;

test('ordinary CSS values pass validation', function ($value) {
    expect(InlineStyle::isValidCSSStyleValue($value))->toBeTrue();
})->with([
    'red', '#ff0000', 'rgb(255, 0, 0)', 'hsl(0, 100%, 50%)',
    'var(--text-color)', '"Open Sans", sans-serif', ' red ', 'start', 'end', 'inherit',
]);

test('empty values and CSS declaration boundaries fail validation', function ($value) {
    expect(InlineStyle::isValidCSSStyleValue($value))->toBeFalse();
})->with([
    'semicolon' => ['red; position: fixed'],
    'opening brace' => ['red{'],
    'closing brace' => ['red}'],
    'quoted separator' => ['"Font; Name"'],
    'empty' => [''],
    'whitespace' => [" \t\n\r"],
    'nul' => ["\0"],
    'null' => [null],
    'true' => [true],
    'false' => [false],
    'integer' => [123],
    'float' => [1.5],
    'array' => [['red']],
    'object' => [(object) ['color' => 'red']],
]);
