<?php
declare(strict_types=1);
/**
 * This file tests Attachments.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Attachment;

/**
 * This file tests Attachments.
 *
 * @package SendGrid\Tests
 */
class AttachmentsTest extends TestCase {

  public function testWillEncodeNonBase64String(): void {
    $attachment = new Attachment();
    $testString = 'Twilio SendGrid is awesome!';

    $attachment->setContent($testString);

    $this->assertEquals(base64_encode($testString), $attachment->getContent());
  }

  public function testWillNotEncodeBase64String(): void {
    $attachment = new Attachment();
    $testString = base64_encode('Twilio SendGrid is awesome!');

    $attachment->setContent($testString);

    $this->assertEquals($testString, $attachment->getContent());
  }
}
