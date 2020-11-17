<?php
/**
 * This file tests TemplateId.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\TemplateId;

/**
 * This class tests TemplateId.
 *
 * @package SendGrid\Tests
 */
class TemplateIdTest extends TestCase {

  public function testConstructor() {
    $templateId = new TemplateId('template_id');

    $this->assertSame('template_id', $templateId->getTemplateId());
  }

  public function testSetTemplateId() {
    $templateId = new TemplateId();
    $templateId->setTemplateId('template_id');

    $this->assertSame('template_id', $templateId->getTemplateId());
  }

  /**
   * @expectedException \SendGrid\Exception\TypeException
   * @expectedExceptionMessage "$template_id" must be a string.
   */
  public function testSetTemplateIdOnInvalidType() {
    $templateId = new TemplateId();
    $templateId->setTemplateId(TRUE);
  }

  public function testJsonSerialize() {
    $templateId = new TemplateId();
    $templateId->setTemplateId('template_id');

    $this->assertSame('template_id', $templateId->jsonSerialize());
  }
}
