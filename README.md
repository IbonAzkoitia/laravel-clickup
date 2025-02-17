# ClickUp for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibon-azkoitia/laravel-clickup.svg?style=flat-square)](https://packagist.org/packages/ibon-azkoitia/laravel-clickup)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ibonazkoitia/laravel-clickup/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/ibonazkoitia/laravel-clickup/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/ibonazkoitia/laravel-clickup/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/ibonazkoitia/laravel-clickup/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/ibon-azkoitia/laravel-clickup.svg?style=flat-square)](https://packagist.org/packages/ibon-azkoitia/laravel-clickup)

---

ClickUp API wrapper for Laravel

## Installation

You can install the package via composer:

```bash
composer require ibon-azkoitia/laravel-clickup
```

## Configuration

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-clickup-config"
```

## Testing

To run the tests, you'll need to set up your test environment:

1. Copy `.env.testing.example` to `.env.testing`

```bash
cp .env.testing.example .env.testing
```

2. Update `.env.testing` with your ClickUp test credentials:
   - `CLICKUP_API_TOKEN`: Your ClickUp API token
   - `CLICKUP_TEST_LIST_ID`: ID of a list in your ClickUp workspace
   - `CLICKUP_TEST_TEAM_ID`: Your ClickUp team ID
   - `CLICKUP_TEST_TASK_ID`: ID of a task in your test list
   - `CLICKUP_TEST_TEMPLATE_ID`: ID of a template in your test list

3. Run the tests:

```bash
composer test
```

Note: The `.env.testing` file is gitignored to prevent committing sensitive credentials.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.