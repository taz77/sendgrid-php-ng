# SendGrid-PHP

**This is a version of SendGrid-PHP which uses Guzzle 6.x**

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=taz77_sendgrid-php-ng&metric=alert_status)](https://sonarcloud.io/dashboard?id=taz77_sendgrid-php-ng)

This library allows you to quickly and easily send emails through SendGrid using
PHP with the help of Guzzle 6.x. Guzzle is a very popular HTTP client for PHP
used in many other PHP packages.

SendGrid has chosen to write their own PHP HTTP client. This module uses Guzzle
instead. From the point that SendGrid choose to provide their own HTTP client
library, this module was permanently forked away from the official code and is
maintained independently of the official libraries. This module uses Guzzle for
the transport layer and so the code is different. Contributions to help maintain
this library is welcome!

Mainly, this API is maintained in support of
the [Drupal Sendgrid Integration Module](https://www.drupal.org/project/sendgrid_integration)
that I also maintain. Drupal 8 ships with Guzzle 6.x in the core of the software
and Guzzle 6.x supports the standardization of PSR messages. The official
Sendgrid PHP API supports only the deprecated Guzzle 3.x as they are maintaining
support for PHP 5.3.

To install this library it is best to use composer. I have published a package
through Packagist for this library. Use the following in your composer.json:

``` php
"require": {
    "fastglass/sendgrid": ">=2.0.0"
  }
```
## Code Examples
Refer to the examples' folder to examine how to use this library. The examples
make use of environment variables for the API key. Export your API stored in
an environment variable named `SENDGRID_API_KEY`.

## Running Tests

The existing tests in the `Tests` directory can be run
using [PHPUnit](https://github.com/sebastianbergmann/phpunit/) with the
following command:

```bash
composer update
composer install
./vendor/bin/phpunit ./Tests
```

or if you already have PHPUnit installed globally.

```bash
cd Tests
phpunit
```
