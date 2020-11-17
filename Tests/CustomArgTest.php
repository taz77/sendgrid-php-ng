<?php
declare(strict_types=1);
/**
 * This file tests CustomArg.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\CustomArg;

/**
 * This file tests CustomArg.
 *
 * @package SendGrid\Tests
 */
class CustomArgTest extends TestCase {

  public function testConstructor(): void {
    $customArg = new CustomArg('key', 'value');

    $this->assertInstanceOf(CustomArg::class, $customArg);
    $this->assertSame('key', $customArg->getKey());
    $this->assertSame('value', $customArg->getValue());
  }

  public function testSetKey(): void {
    $customArg = new CustomArg();
    $customArg->setKey('key');

    $this->assertSame('key', $customArg->getKey());
  }

  public function testSetKeyOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$key" must be a string.');
    $customArg = new CustomArg();
    $customArg->setKey(['key']);
  }

  public function testSetValue() {
    $customArg = new CustomArg();
    $customArg->setValue('value');

    $this->assertSame('value', $customArg->getValue());
  }

  public function testSetValueOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$value" must be a string.');
    $customArg = new CustomArg();
    $customArg->setValue(['value']);
  }
}
