# Change Log
All notable changes to this project will be documented in this file.
This project adheres to [Semantic Versioning](http://semver.org/).

## [2.0.1](https://github.com/taz77/sendgrid-php-ng/tree/v2.0.0) (2020-11-20)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v2.0.0...v2.0.1)

Patch release to remove duplicate folder created by case-insensitive file system.

## [2.0.0](https://github.com/taz77/sendgrid-php-ng/tree/v2.0.0) (2020-11-18)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.11...v2.0.0)

**Major Update**

Version 2.0.0 is an upgrade to the [V3 API](https://sendgrid.com/docs/API_Reference/api_v3.html). 
This is a breaking upgrade. It is not backwardly compatible to v1 of this library. 

## [1.0.12](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.12) (2020-11-18)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.11...v1.0.12)

## [1.0.11](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.11) (2019-01-15)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.10...v1.0.11)

## [1.0.10](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.10) (2018-09-08)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.9...v1.0.10)

**Fixed issues:**
- Upgrade [PHPUnit](https://github.com/taz77/sendgrid-php-ng/issues/17) to 7.3

## [1.0.9](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.9) (2018-08-15)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.8...v1.0.9)

**Fixed issues:**
- PHP 7.2 compatibility [issue](https://github.com/taz77/sendgrid-php-ng/issues/15) with count()

## [1.0.8](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.8) (2017-08-16)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.7...v1.0.8)

**Fixed issues:**
- Incorrect Client method in example documentation

## [1.0.7](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.7) (2016-07-20)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.6...v1.0.7)

**Fixed bugs:**
- Test were failing due to missed version update in constant

## [1.0.6](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.6) (2016-07-19)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.5...v1.0.6)

**Security:**
- Force loading of Guzzle 6.2.1 or greater that addresses [CVE-2016-5385](http://www.cve.mitre.org/cgi-bin/cvename.cgi?name=2016-5385) (HTTPOXY)

## [1.0.5](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.5) (2016-06-30)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.4...v1.0.5)

**New Features:**
- Support PSR-4 Naming and Loading

## [1.0.4](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.4) (2016-01-29)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.3...v1.0.4)

**Fixed bugs:**
- Allow for attachments to be sent.

**New Features:**
- API changed to allow for multipart messages.

## [1.0.3](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.3) (2016-01-26)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.2...v1.0.3)
- Return the method getTos() for use in debugging email messages before they are sent.

## [1.0.2](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.2) (2016-01-08)
[Full Changelog](https://github.com/taz77/sendgrid-php-ng/compare/v1.0.0...v1.0.2)
- Documentation updates.

## [1.0.0](https://github.com/taz77/sendgrid-php-ng/tree/v1.0.0) (2015-10-29)
- Fork and Initial Release
