# Tiptap for PHP
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)
[![GitHub Tests Action Status](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)
[![License](https://img.shields.io/packagist/l/ueberdosis/tiptap-php?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)
[![Chat](https://img.shields.io/badge/chat-on%20discord-7289da.svg?sanitize=true)](https://discord.gg/WtJ49jGshW)
[![Sponsor](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub)](https://github.com/sponsors/ueberdosis)

A PHP package to work with [Tiptap](https://tiptap.dev/) content. You can transform Tiptap-compatible JSON to HTML, and the other way around. You can also use it sanitize your content, or even to modify it.

## Installation
You can install the package via composer:

```bash
composer require ueberdosis/tiptap-php
```

## Usage
The PHP package mimics large parts of the JavaScript package. If you know your way around Tiptap, the PHP syntax will feel familiar to you.

### Convert Tiptap HTML to JSON
Let’s start by converting a HTML snippet to a PHP array with a Tiptap-compatible structure:

```php
(new Tiptap\Editor)
    ->setContent('<p>Example Text</p>')
    ->getDocument();

// Returns:
// ['type' => 'doc', 'content' => …]
```

The JavaScript package returns a JSON string. You can do this in PHP, too.

```php
(new Tiptap\Editor)
    ->setContent('<p>Example Text</p>')
    ->getJSON();

// Returns:
// {"type": "doc", "content": …}
```

### Convert Tiptap JSON to HTML
The other way works aswell. Just pass a JSON string or an PHP array to generate the HTML.

```php
(new Tiptap\Editor)
    ->setContent([
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Example Text',
                    ],
                ]
            ]
        ],
    ])
    ->getHTML();

// Returns:
// <h1>Example Text</h1>
```

This doesn’t fully adhere to the ProseMirror schema. Some things are supported too, for example aren’t marks allowed in a `CodeBlock`.

If you need better schema support, create an issue with the feature you’re missing.

### Sanitize content
A great use case for the PHP package is to clean (or “sanitize”) the content. You can do that with the `sanitize()` method. Works with JSON strings, PHP arrays and HTML.

It’ll return the same format you’re using as the input format.

```php
(new Tiptap\Editor)
    ->sanitize('<p>Example Text<script>alert("HACKED!")</script></p>');

// Returns:
// '<p>Example Text</p>'
```

### Modifying the content
With the `descendants()` method you can loop through all nodes recursively as you are used to from the JavaScript package. But in PHP, you can even modify the node to update attributes and all that.

> Warning: You need to add `&` to the parameter. Thats keeping a reference to the original item and allows to modify the original one, instead of just a copy.

```php
$editor->descendants(function (&$node) {
    if ($node->type !== 'heading') {
        return;
    }

    $node->attrs->level = 1;
});
```

### Extensions
By default, the [`StarterKit`](https://tiptap.dev/api/extensions/starter-kit) is loaded, but you can pass a custom array of extensions aswell.

```php
new Tiptap\Editor([
    'extensions' => [
        new Tiptap\Nodes\StarterKit,
        new Tiptap\Nodes\Link,
    ],
])
```

### Configure extensions
Some extensions can be configured. Just pass an array to the constructor, that’s it. We’re aiming to support the same configuration as the JavaScript package.

```php
new Tiptap\Editor([
    'extensions' => [
        // …
        new Tiptap\Nodes\Heading([
            'levels' => [1, 2, 3],
        ]),
    ],
])
```

You can pass custom HTML attributes through the configuration, too.

```php
new Tiptap\Editor([
    'extensions' => [
        // …
        new Tiptap\Nodes\Heading([
            'HTMLAttributes' => [
                'class' => 'my-custom-class',
            ],
        ]),
    ],
])
```

### Extend existing extensions
If you need to change minor details of the supported extensions, you can just extend an extension.

```php
<?php

class CustomBold extends \Tiptap\Marks\Bold
{
    public function renderHTML($mark)
    {
        // Renders <b> instead of <strong>
        return ['b', 0]
    }
}

new Tiptap\Editor([
    'extensions' => [
        new Paragraph,
        new Text,
        new CustomBold,
    ],
])
```

#### Custom extensions
You can even build custom extensions. If you are used to the JavaScript API, you will be surprised how much of that works in PHP, too. 🤯 Find a simple example below.

Make sure to dig through the extensions in this repository to learn more about the PHP extension API.

```php
<?php

use Tiptap\Core\Node;

class CustomNode extends Node
{
    public static $name = 'customNode';

    public function addOptions()
    {
        return [
            'HTMLAttributes' => [],
        ];
    }

    public function parseHTML()
    {
        return [
            [
                'tag' => 'my-custom-tag[data-id]',
            ],
            [
                'tag' => 'my-custom-tag',
                'getAttrs' => function ($DOMNode) {
                    return ! \Tiptap\Utils\InlineStyle::hasAttribute($DOMNode, [
                        'background-color' => '#000000',
                    ]) ? null : false;
                },
            ],
            [
                'style' => 'background-color',
                'getAttrs' => function ($value) {
                    return (bool) preg_match('/^(black)$/', $value) ? null : false;
                },
            ],
        ];
    }

    public function renderHTML($node)
    {
        return ['my-custom-tag', ['class' => 'foobar'], 0]
    }
}
```

## Testing
```bash
composer test
```

You can install nodemon (`npm install -g nodemon`) to keep the test suite running and watch for file changes:

```bash
composer test-watch
```

## Contributing
Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
- [Hans Pagel](https://github.com/hanspagel)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
