<?php
declare(strict_types=1);
/**
 * This file tests SpamCheck.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\SpamCheck;

/**
 * This class tests SpamCheck.
 *
 * @package SendGrid\Tests
 */
class SpamCheckTest extends TestCase {

  public function testConstructor(): void {
    $spamCheck = new SpamCheck(TRUE, 1, 'http://post-to.url');

    $this->assertInstanceOf(SpamCheck::class, $spamCheck);
    $this->assertTrue($spamCheck->getEnable());
    $this->assertSame(1, $spamCheck->getThreshold());
    $this->assertSame('http://post-to.url', $spamCheck->getPostToUrl());
  }

  public function testSetEnable(): void {
    $spamCheck = new SpamCheck();
    $spamCheck->setEnable(TRUE);

    $this->assertTrue($spamCheck->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $spamCheck = new SpamCheck();
    $spamCheck->setEnable('invalid_bool_type');
  }

  public function testSetThreshold(): void {
    $spamCheck = new SpamCheck();
    $spamCheck->setThreshold(1);
    $this->assertSame(1, $spamCheck->getThreshold());
  }

  public function testSetThresholdOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$threshold" must be an integer.');
    $spamCheck = new SpamCheck();
    $spamCheck->setThreshold('invalid_int_type');
  }

  public function testSetPostToUrl(): void {
    $spamCheck = new SpamCheck();
    $spamCheck->setPostToUrl('http://post-to.url');
    $this->assertSame('http://post-to.url', $spamCheck->getPostToUrl());
  }

  public function testSetPostToUrlOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$post_to_url" must be a string.');
    $spamCheck = new SpamCheck();
    $spamCheck->setPostToUrl(TRUE);
  }
}
