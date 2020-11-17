<?php
/**
 * This file tests Subject.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Subject;

/**
 * This class tests Subject.
 *
 * @package SendGrid\Tests
 */
class SubjectTest extends TestCase {

  public function testConstructor() {
    $subject = new Subject('subject');

    $this->assertInstanceOf(Subject::class, $subject);
    $this->assertSame('subject', $subject->getSubject());
  }

  public function testSetSubject() {
    $subject = new Subject();
    $subject->setSubject('subject');

    $this->assertSame('subject', $subject->getSubject());
  }

  public function testJsonSerialize() {
    $subject = new Subject();
    $subject->setSubject('subject');

    $this->assertSame('subject', $subject->jsonSerialize());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$subject" must be a string.
   */
  public function testSetSubjectOnInvalidType() {
    $subject = new Subject();
    $subject->setSubject(TRUE);
  }
}
