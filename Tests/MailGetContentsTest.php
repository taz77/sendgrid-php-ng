<?php
declare(strict_types=1);

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Mail;

/**
 * This class tests the getContents() function in SendGrid\Mail\Mail.
 *
 * @package SendGrid\Tests
 */
class MailGetContentsTest extends TestCase {

  /**
   * This method tests that array from Mail getContents() returns with
   * text/plain Content object first when Mail instantiated with text/html
   * content before text/plain
   *
   * @throws \SendGrid\Exception\TypeException
   */
  public function testWillReturnPlainContentFirst(): void {
    $email = new Mail();
    $email->setFrom("test@example.com", NULL);
    $email->setSubject("Hello World from the Twilio SendGrid PHP Library");
    $email->addTo("test@example.com", "Test Person");
    $email->addContent("text/html", "<p>some text here</p>");
    $email->addContent("text/plain", "some text here");
    $this->assertEquals('text/plain', $email->getContents()[0]->getType());
  }
}
