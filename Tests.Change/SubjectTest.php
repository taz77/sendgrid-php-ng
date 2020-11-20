<?php
declare(strict_types=1);
/**
 * This file tests Subject.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Subject;

/**
 * This class tests Subject.
 *
 * @package SendGrid\Tests
 */
class SubjectTest extends TestCase {

  public function testConstructor(): void {
    $subject = new Subject('subject');

    $this->assertInstanceOf(Subject::class, $subject);
    $this->assertSame('subject', $subject->getSubject());
  }

  public function testSetSubject(): void {
    $subject = new Subject();
    $subject->setSubject('subject');

    $this->assertSame('subject', $subject->getSubject());
  }

  public function testJsonSerialize(): void {
    $subject = new Subject();
    $subject->setSubject('subject');

    $this->assertSame('subject', $subject->jsonSerialize());
  }

  public function testSetSubjectOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$subject" must be a string.');
    $subject = new Subject();
    $subject->setSubject(TRUE);
  }
}
