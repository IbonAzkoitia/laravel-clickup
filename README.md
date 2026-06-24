# ClickUp API wrapper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibonazkoitia/laravel-clickup.svg?style=flat-square)](https://packagist.org/packages/ibonazkoitia/laravel-clickup)
[![GitHub Tests Action Status](https://github.com/spatie/package-laravel-clickup-laravel/actions/workflows/run-tests.yml/badge.svg)](https://github.com/ibonazkoitia/laravel-clickup/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://github.com/spatie/package-laravel-clickup-laravel/actions/workflows/fix-php-code-style-issues.yml/badge.svg)](https://github.com/ibonazkoitia/laravel-clickup/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibonazkoitia/laravel-clickup.svg?style=flat-square)](https://packagist.org/packages/ibonazkoitia/laravel-clickup)

There is no need for you to recreate all the ClickUp API endpoints, we have already done that for you.

## Installation

You can install the package via composer:

```bash
composer require ibonazkoitia/laravel-clickup
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="clickup-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$clickup = new IbonAzkoitia\Clickup();
echo $clickup->echoPhrase('Hello, IbonAzkoitia!');
```

## Testing

```bash
composer test
```
> **Important:** The test suite interacts with the actual ClickUp API. Please use a development workspace for testing to avoid affecting production data.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Ibon Azkoitia](https://github.com/ibonazkoitia)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
