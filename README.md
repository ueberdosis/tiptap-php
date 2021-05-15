# tiptap for PHP
[![Latest Version on Packagist](https://img.shields.io/packagist/v/ueberdosis/tiptap.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/ueberdosis/tiptap/run-tests?label=tests)](https://github.com/ueberdosis/tiptap/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/ueberdosis/tiptap/Check%20&%20fix%20styling?label=code%20style)](https://github.com/ueberdosis/tiptap/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/ueberdosis/tiptap.svg?style=flat-square)](https://packagist.org/packages/ueberdosis/tiptap)

A PHP package to work with tiptap output.

## Installation
You can install the package via composer:

```bash
composer require ueberdosis/tiptap
```

## Usage
### Convert tiptap HTML to JSON
```php
$json = (new Tiptap\Tiptap)->setContent('<p>Example Text</p>')->getDocument();
```

### Convert tiptap JSON to HTML
```php
$html = (new Tiptap\Tiptap)->setContent([
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
