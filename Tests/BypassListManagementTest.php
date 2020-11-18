<?php
declare(strict_types=1);
/**
 * This file tests BypassListManagement.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BypassListManagement;
use  SendGrid\Exception\TypeException;

/**
 * This file tests BypassListManagement.
 *
 * @package SendGrid\Tests
 */
class BypassListManagementTest extends TestCase {

  public function testConstructor(): void {
    $bypassListManagement = new BypassListManagement(TRUE);

    $this->assertInstanceOf(BypassListManagement::class, $bypassListManagement);
    $this->assertTrue($bypassListManagement->getEnable());
  }

  public function testSetEnable(): void {
    $bypassListManagement = new BypassListManagement();
    $bypassListManagement->setEnable(TRUE);

    $this->assertTrue($bypassListManagement->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $bypassListManagement = new BypassListManagement();
    $bypassListManagement->setEnable('invalid_bool_type');
  }
}
