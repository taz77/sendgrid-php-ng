<?php
declare(strict_types=1);
/**
 * This file tests Mail.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;

/**
 * This class tests Mail.
 *
 * @package SendGrid\Tests
 */
class MailTest extends TestCase {

  public function testConstructor(): void {
    $mail = new Mail();
    $this->assertInstanceOf(Mail::class, $mail);
    $this->assertSame(1, $mail->getPersonalizationCount());
  }
}
