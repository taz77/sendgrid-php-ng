<?php
/**
 * This file tests ClickTracking.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\ClickTracking;

/**
 * This file tests ClickTracking.
 *
 * @package SendGrid\Tests
 */
class ClickTrackingTest extends TestCase {

  public function testConstructor() {
    $clickTracking = new ClickTracking(TRUE, TRUE);

    $this->assertInstanceOf(ClickTracking::class, $clickTracking);
    $this->assertTrue($clickTracking->getEnable());
    $this->assertTrue($clickTracking->getEnableText());
  }

  public function testSetEnable() {
    $clickTracking = new ClickTracking();
    $clickTracking->setEnable(TRUE);

    $this->assertTrue($clickTracking->getEnable());
  }

  public function testSetEnableOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $clickTracking = new ClickTracking();
    $clickTracking->setEnable('invalid_bool');
  }

  public function testSetEnableText() {
    $clickTracking = new ClickTracking();
    $clickTracking->setEnableText(TRUE);

    $this->assertTrue($clickTracking->getEnableText());
  }

  public function testSetEnableTextOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable_text" must be a boolean.');
    $clickTracking = new ClickTracking();
    $clickTracking->setEnableText('invalid_bool');
  }
}
