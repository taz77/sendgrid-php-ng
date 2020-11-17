<?php
/**
 * This file tests BccSettings.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BccSettings;

/**
 * This file tests BccSettings.
 *
 * @package SendGrid\Tests
 */
class BccSettingsTest extends TestCase {

  public function testConstructor() {
    $bccSettings = new BccSettings(TRUE, 'dx@sendgrid.com');

    $this->assertInstanceOf(BccSettings::class, $bccSettings);
    $this->assertTrue($bccSettings->getEnable());
    $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
  }

  public function testSetEmail() {
    $bccSettings = new BccSettings();
    $bccSettings->setEmail('dx@sendgrid.com');

    $this->assertSame('dx@sendgrid.com', $bccSettings->getEmail());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$email" must be a valid email address.
   */
  public function testSetEmailOnInvalidEmailFormat() {
    $bccSettings = new BccSettings();
    $bccSettings->setEmail('invalid_email_address');
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$email" must be a string.
   */
  public function testSetEmailOnInvalidType() {
    $bccSettings = new BccSettings();
    $bccSettings->setEmail(['invalid_type']);
  }

  public function testSetEnable() {
    $bccSettings = new BccSettings();
    $bccSettings->setEnable(TRUE);

    $this->assertTrue($bccSettings->getEnable());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$enable" must be a boolean.
   */
  public function testSetEnableOnInvalidType() {
    $bccSettings = new BccSettings();
    $bccSettings->setEnable('invalid_bool_type');
  }
}
