# Tiptap for PHP
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)
[![GitHub Tests Action Status](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://github.com/ueberdosis/tiptap-php/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/ueberdosis/tiptap-php/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)

A PHP package to work with Tiptap output. You can transform Tiptap-compatible JSON to HTML, and the other way around. Or you can use it sanitize your content.

## Tasks
- [x] Publish the package then
- [x] Get tests passing
- [ ] Migrate to Pest PHP
- [ ] Check if all Tiptap core packages are supported
- [ ] Add support for configureable HTML attributes
- [x] Make the renderHTML syntax more like the JS API
  - [x] `['code', ['pre']]` instead of `['core', 'pre']`
  - [x] support for attributes `['code', ['class' => 'foo'], ['pre']]`
  - [ ] Merge classes and inline styles properly
- [ ] Get rid of the `wrapper()` method
- [x] Integrate the addAttributes API for Nodes/Marks

## Installation
You can install the package via composer:

```bash
composer require ueberdosis/tiptap-php
```

## Usage
### Convert Tiptap HTML to JSON
```php
$document = (new Tiptap\Editor)->setContent('<p>Example Text</p>')->getDocument();

// Output: ['type' => 'doc', 'content' => …]
```

### Convert Tiptap JSON to HTML
```php
$html = (new Tiptap\Editor)->setContent([
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
])->getHTML();

// Output: <h1>Example Text</h1>
```

### Sanitize content
```php
$document = (new Tiptap\Editor)->sanitize('<p>Example Text<script>alert("HACKED!")</script></p>');

// Output: '<p>Example Text</p>'
```

### Extensions
By default, the `StarterKit` is loaded, but you can pass a custom array of extensions aswell.

```php
new Tiptap\Editor([
    'extensions' => [
        new Tiptap\Nodes\Heading(),
    ],
])
```

#### Custom extensions
You can even build custom extensions, like you’re used to from the JavaScript package.

```php
<?php

namespace App\Tiptap\Nodes;

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

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities
Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits
- [Hans Pagel](https://github.com/hanspagel)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
