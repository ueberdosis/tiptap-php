# Tiptap for PHP
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)
[![GitHub Tests Action Status](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ueberdosis/tiptap-php/actions/workflows/run-tests.yml)
[![GitHub Code Style Action Status](https://github.com/ueberdosis/tiptap-php/actions/workflows/php-cs-fixer.yml/badge.svg)](https://github.com/ueberdosis/tiptap-php/actions/workflows/php-cs-fixer.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/ueberdosis/tiptap-php.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap-php)

A PHP package to work with Tiptap output. You can transform Tiptap-compatible JSON to HTML, and the other way around. Or you can use it sanitize your content.

## Tasks
- [ ] Publish the package then
- [ ] Get tests passing
- [ ] Migrate to Pest PHP
- [ ] Check if all Tiptap core packages are supported
- [ ] Add support for configureable HTML attributes
- [ ] Integrate the addAttributes API for Nodes/Marks

## Installation
You can install the package via composer:

```bash
composer require ueberdosis/tiptap-php
```

## Usage
### Convert Tiptap HTML to JSON
```php
$document = (new Tiptap\Editor)->setContent('<p>Example Text</p>')->getDocument();
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
```

### Sanitize content
```php
$document = (new Tiptap\Editor)->sanitize('<p>Example Text<script>alert("HACKED!")</script></p>');
// Output: '<p>Example Text</p>'
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
