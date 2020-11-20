<?php
declare(strict_types=1);
/**
 * This file tests Section.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Section;

/**
 * This class tests Section.
 *
 * @package SendGrid\Tests
 */
class SectionTest extends TestCase {

  public function testConstructor(): void {
    $section = new Section('key', 'value');

    $this->assertInstanceOf(Section::class, $section);
    $this->assertSame('key', $section->getKey());
    $this->assertSame('value', $section->getValue());
  }

  public function testSetKey(): void {
    $section = new Section();
    $section->setKey('key');

    $this->assertSame('key', $section->getKey());
  }

  public function testSetKeyOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$key" must be a string.');
    $section = new Section();
    $section->setKey(TRUE);
  }

  public function testSetValue(): void {
    $section = new Section();
    $section->setValue('value');

    $this->assertSame('value', $section->getValue());
  }

  public function testSetValueOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$value" must be a string.');
    $section = new Section();
    $section->setValue(TRUE);
  }
}
