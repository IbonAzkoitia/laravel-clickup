# ClickUp for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibon-azkoitia/laravel-clickup.svg?style=flat-square)](https://packagist.org/packages/ibon-azkoitia/laravel-clickup)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/ibonazkoitia/laravel-clickup/run-tests.yml?branch=main&style=flat-square)](https://github.com/ibonazkoitia/laravel-clickup/actions/workflows/run-tests.yml)
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
php artisan vendor:publish --tag="clickup-config"
```

## Testing

### Local Testing Setup

To run the tests locally, you'll need to:

1. Copy `.env.testing.example` to `.env.testing`:
```bash
cp .env.testing.example .env.testing
```

2. Update `.env.testing` with your ClickUp test credentials:
   - `CLICKUP_API_TOKEN`: Your ClickUp API token
   - `CLICKUP_TEST_LIST_ID`: ID of a list in your ClickUp workspace
   - `CLICKUP_TEST_TEAM_ID`: Your ClickUp team ID
   - `CLICKUP_TEST_TASK_ID`: ID of a task in your test list
   - `CLICKUP_TEST_TASK_ID_2`: ID of another task in your test list
   - `CLICKUP_TEST_TEMPLATE_ID`: ID of a template in your test list

3. Run the tests:
```bash
composer test
```

> **Important:** The test suite interacts with the actual ClickUp API. Please use a development workspace for testing to avoid affecting production data.

### Contributing & Pull Requests

When submitting a pull request:

1. Ensure all tests pass locally using your own ClickUp test credentials
2. The GitHub Actions workflow will run:
   - Code style checks
   - Static analysis
   - Basic syntax validation
3. Full API integration tests will only run in the maintainer's environment to protect the test workspace

> **Note:** For security reasons, integration tests that interact with the ClickUp API will only run for repository maintainers. Contributors should thoroughly test their changes locally using their own ClickUp workspace before submitting PRs.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.