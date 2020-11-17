<?php
declare(strict_types=1);
/**
 * This file tests Ganalytics.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Ganalytics;

/**
 * This file tests Ganalytics.
 *
 * @package SendGrid\Tests
 */
class GanalyticsTest extends TestCase {

  public function testConstructor(): void {
    $ganalytics = new Ganalytics(TRUE, 'utm_source', 'utm_medium', 'utm_term', 'utm_content', 'utm_campaign');

    $this->assertInstanceOf(Ganalytics::class, $ganalytics);
    $this->assertTrue($ganalytics->getEnable());
    $this->assertSame('utm_source', $ganalytics->getCampaignSource());
    $this->assertSame('utm_medium', $ganalytics->getCampaignMedium());
    $this->assertSame('utm_term', $ganalytics->getCampaignTerm());
    $this->assertSame('utm_content', $ganalytics->getCampaignContent());
    $this->assertSame('utm_campaign', $ganalytics->getCampaignName());
  }

  public function testSetEnable(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setEnable(TRUE);

    $this->assertTrue($ganalytics->getEnable());
  }

  public function testSetEnableOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$enable" must be a boolean.');
    $ganalytics = new Ganalytics();
    $ganalytics->setEnable('invalid_bool');
  }

  public function testSetCampaignContent(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignContent('utm_content');

    $this->assertSame('utm_content', $ganalytics->getCampaignContent());
  }

  public function testSetCampaignContentOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$utm_content" must be a string.');
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignContent(['invalid_utm_content']);
  }

  public function testSetCampaignTerm(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignTerm('utm_term');

    $this->assertSame('utm_term', $ganalytics->getCampaignTerm());
  }

  public function testSetCampaignTermOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$utm_term" must be a string.');
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignTerm(['invalid_utm_term']);
  }

  public function testSetCampaignMedium(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignMedium('utm_medium');

    $this->assertSame('utm_medium', $ganalytics->getCampaignMedium());
  }

  public function testSetCampaignMediumOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$utm_medium" must be a string.');
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignMedium(['invalid_utm_medium']);
  }

  public function testSetCampaignSource(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignSource('utm_campaign');

    $this->assertSame('utm_campaign', $ganalytics->getCampaignSource());
  }

  public function testSetCampaignSourceOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$utm_source" must be a string.');
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignSource(['invalid_utm_campaign']);
  }

  public function testSetCampaignName(): void {
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignName('utm_campaign_name');

    $this->assertSame('utm_campaign_name', $ganalytics->getCampaignName());
  }

  public function testSetCampaignNameOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$utm_campaign" must be a string.');
    $ganalytics = new Ganalytics();
    $ganalytics->setCampaignName(['invalid_utm_campaign_name']);
  }
}
