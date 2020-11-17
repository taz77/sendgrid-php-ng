<?php
declare(strict_types=1);
/**
 * This file tests Content.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Content;

/**
 * This file tests Content.
 *
 * @package SendGrid\Tests
 */
class ContentTest extends TestCase {

  public function testConstructor() {
    $content = new Content('type', 'value');

    $this->assertInstanceOf(Content::class, $content);
    $this->assertSame('type', $content->getType());
    $this->assertSame('value', $content->getValue());
  }

  public function testSetType() {
    $content = new Content();
    $content->setType('type');

    $this->assertSame('type', $content->getType());
  }

  public function testSetTypeOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$type" must be a string.');
    $content = new Content();
    $content->setType(['type']);
  }

  public function testSetValue() {
    $content = new Content();
    $content->setValue('value');

    $this->assertSame('value', $content->getValue());
  }

  public function testSetValueOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$value" must be a string.');
    $content = new Content();
    $content->setValue(['value']);
  }
}
