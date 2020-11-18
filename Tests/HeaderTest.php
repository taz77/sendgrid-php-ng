<?php
declare(strict_types=1);
/**
 * This file tests Header.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Header;

/**
 * This file tests Header.
 *
 * @package SendGrid\Tests
 */
class HeaderTest extends TestCase {

  public function testConstructor(): void {
    $header = new Header('Content-Type', 'text/plain');
    $this->assertSame('Content-Type', $header->getKey());
    $this->assertSame('text/plain', $header->getValue());
  }

  public function testSetKey(): void {
    $header = new Header();
    $header->setKey('Content-Type');
    $this->assertSame('Content-Type', $header->getKey());
  }

  public function testSetKeyOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$key" must be a string.');
    $header = new Header();
    $header->setKey(['Content-Type']);
  }

  public function testSetValue(): void {
    $header = new Header();
    $header->setValue('text/plain');
    $this->assertSame('text/plain', $header->getValue());
  }

  public function testSetValueOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$value" must be a string.');
    $header = new Header();
    $header->setValue(['text/plain']);
  }
}
