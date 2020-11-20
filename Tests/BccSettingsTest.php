<?php
declare(strict_types=1);
/**
 * This file tests BccSettings.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BccSettings;
use \SendGrid\Exception\TypeException;

/**
 * This file tests BccSettings.
 *
 * @package SendGrid\Tests
 */
class BccSettingsTest extends TestCase {

  public function testConstructor(): void {
    $bccSettings = new BccSettings(TRUE, 'dx@sendgrid.com');

    $this->assertInstanceOf(BccSettings::class, $bccSettings);
    $this->assertTrue($bccSettings->getEnable());
    $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
  }

  public function testSetEmail(): void {
    $bccSettings = new BccSettings();
    $bccSettings->setEmail('dx@sendgrid.com');

    $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
  }

  public function testSetEmailOnInvalidEmailFormat(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$email" must be a valid email address.');
    $bccSettings = new BccSettings();
    $bccSettings->setEmail('invalid_email_address');
  }

  public function testSetEmailOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$email" must be a string.');
    $bccSettings = new BccSettings();
    $bccSettings->setEmail(['invalid_type']);
  }

  public function testSetEnable(): void {
    $bccSettings = new BccSettings();
    $bccSettings->setEnable(TRUE);

    $this->assertTrue($bccSettings->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $bccSettings = new BccSettings();
    $bccSettings->setEnable('invalid_bool_type');
  }
}
