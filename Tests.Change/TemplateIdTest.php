<?php
declare(strict_types=1);
/**
 * This file tests TemplateId.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\TemplateId;

/**
 * This class tests TemplateId.
 *
 * @package SendGrid\Tests
 */
class TemplateIdTest extends TestCase {

  public function testConstructor(): void {
    $templateId = new TemplateId('template_id');

    $this->assertSame('template_id', $templateId->getTemplateId());
  }

  public function testSetTemplateId(): void {
    $templateId = new TemplateId();
    $templateId->setTemplateId('template_id');

    $this->assertSame('template_id', $templateId->getTemplateId());
  }

  public function testSetTemplateIdOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$template_id" must be a string');
    $templateId = new TemplateId();
    $templateId->setTemplateId(TRUE);
  }

  public function testJsonSerialize(): void {
    $templateId = new TemplateId();
    $templateId->setTemplateId('template_id');

    $this->assertSame('template_id', $templateId->jsonSerialize());
  }
}
