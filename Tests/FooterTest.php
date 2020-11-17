<?php
declare(strict_types=1);
/**
 * This file tests Footer.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Footer;

/**
 * This file tests Footer.
 *
 * @package SendGrid\Tests
 */
class FooterTest extends TestCase {

  public function testConstructor(): void {
    $footer = new Footer(TRUE, 'footer_text', '<p>footer_html</p>');

    $this->assertInstanceOf(Footer::class, $footer);
    $this->assertTrue($footer->getEnable());
    $this->assertSame('footer_text', $footer->getText());
    $this->assertSame('<p>footer_html</p>', $footer->getHtml());
  }

  public function testSetEnable(): void {
    $footer = new Footer();
    $footer->setEnable(TRUE);

    $this->assertTrue($footer->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $footer = new Footer();
    $footer->setEnable('invalid_bool');
  }

  public function testSetText() {
    $footer = new Footer();
    $footer->setText('footer_text');

    $this->assertSame('footer_text', $footer->getText());
  }

  public function testSetTextOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$text" must be a string.');
    $footer = new Footer();
    $footer->setText(['footer_text']);
  }

  public function testSetHtml(): void {
    $footer = new Footer();
    $footer->setHtml('footer_html');

    $this->assertSame('footer_html', $footer->getHtml());
  }

  public function testSetHtmlOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$html" must be a string.');
    $footer = new Footer();
    $footer->setHtml(['footer_html']);
  }
}
