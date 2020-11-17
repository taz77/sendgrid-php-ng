<?php
declare(strict_types=1);
/**
 * This file tests SendAt.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\SendAt;

/**
 * This class tests SendAt.
 *
 * @package SendGrid\Tests
 */
class SendAtTest extends TestCase {

  public function testConstructor(): void {
    $sendAt = new SendAt(1539368762);
    $this->assertInstanceOf(SendAt::class, $sendAt);
    $this->assertSame(1539368762, $sendAt->getSendAt());
  }

  public function testSendAt(): void {
    $sendAt = new SendAt();
    $sendAt->setSendAt(1539368762);
    $this->assertSame(1539368762, $sendAt->getSendAt());
  }

  public function testSendAtOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$send_at" must be an integer.');
    $sendAt = new SendAt();
    $sendAt->setSendAt('invalid_int_type');
  }
}
