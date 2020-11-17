<?php
/**
 * This file tests SendAt.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\SendAt;

/**
 * This class tests SendAt.
 *
 * @package SendGrid\Tests
 */
class SendAtTest extends TestCase {

  public function testConstructor() {
    $sendAt = new SendAt(1539368762);

    $this->assertInstanceOf(SendAt::class, $sendAt);
    $this->assertSame(1539368762, $sendAt->getSendAt());
  }

  public function testSendAt() {
    $sendAt = new SendAt();
    $sendAt->setSendAt(1539368762);

    $this->assertSame(1539368762, $sendAt->getSendAt());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$send_at" must be an integer.
   */
  public function testSendAtOnInvalidType() {
    $sendAt = new SendAt();
    $sendAt->setSendAt('invalid_int_type');
  }
}
