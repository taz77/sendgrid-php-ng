<?php
declare(strict_types=1);
/**
 * This file tests PlainTextContent.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\PlainTextContent;

/**
 * This class tests PlainTextContent.
 *
 * @package SendGrid\Tests
 */
class PlainTextContentTest extends TestCase {

  public function testConstructor(): void {
    $plainTextContent = new PlainTextContent('plain text');
    $this->assertSame('plain text', $plainTextContent->getValue());
  }
}
