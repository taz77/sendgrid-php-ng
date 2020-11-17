<?php
/**
 * This file tests SandBoxMode.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\SandBoxMode;

/**
 * This class tests SandBoxMode.
 *
 * @package SendGrid\Tests
 */
class SandBoxModeTest extends TestCase {

  public function testConstructor() {
    $sandBoxMode = new SandBoxMode(TRUE);

    $this->assertInstanceOf(SandBoxMode::class, $sandBoxMode);
    $this->assertTrue($sandBoxMode->getEnable());
  }

  public function testSetEnable() {
    $sandBoxMode = new SandBoxMode();
    $sandBoxMode->setEnable(TRUE);

    $this->assertTrue($sandBoxMode->getEnable());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$enable" must be a boolean.
   */
  public function testSetEnableOnInvalidType() {
    $sandBoxMode = new SandBoxMode();
    $sandBoxMode->setEnable('invalid_bool');
  }
}
