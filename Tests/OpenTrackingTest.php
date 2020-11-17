<?php
declare(strict_types=1);
/**
 * This file tests OpenTracking.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\OpenTracking;

/**
 * This class tests OpenTracking.
 *
 * @package SendGrid\Tests
 */
class OpenTrackingTest extends TestCase {

  public function testConstructor() {
    $openTracking = new OpenTracking(TRUE, 'substitution_tag');
    $this->assertTrue($openTracking->getEnable());
    $this->assertSame('substitution_tag', $openTracking->getSubstitutionTag());
  }

  public function testSetEnable() {
    $openTracking = new OpenTracking();
    $openTracking->setEnable(TRUE);
    $this->assertTrue($openTracking->getEnable());
  }

  public function testSetEnableOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $openTracking = new OpenTracking();
    $openTracking->setEnable('invalid_bool');
  }

  public function testSetSubstitutionTag() {
    $openTracking = new OpenTracking();
    $openTracking->setSubstitutionTag('substitution_tag');
    $this->assertSame('substitution_tag', $openTracking->getSubstitutionTag());
  }

  public function testSetSubstitutionTagOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$substitution_tag" must be a string.');
    $openTracking = new OpenTracking();
    $openTracking->setSubstitutionTag(['invalid_substitution_tag']);
  }
}
