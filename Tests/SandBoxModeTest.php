<?php
declare(strict_types=1);
/**
 * This file tests SandBoxMode.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\SandBoxMode;

/**
 * This class tests SandBoxMode.
 *
 * @package SendGrid\Tests
 */
class SandBoxModeTest extends TestCase {

  public function testConstructor(): void {
    $sandBoxMode = new SandBoxMode(TRUE);
    $this->assertInstanceOf(SandBoxMode::class, $sandBoxMode);
    $this->assertTrue($sandBoxMode->getEnable());
  }

  public function testSetEnable(): void {
    $sandBoxMode = new SandBoxMode();
    $sandBoxMode->setEnable(TRUE);
    $this->assertTrue($sandBoxMode->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $sandBoxMode = new SandBoxMode();
    $sandBoxMode->setEnable('invalid_bool');
  }
}
