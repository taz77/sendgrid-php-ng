<?php
declare(strict_types=1);
/**
 * This file tests TrackingSettings.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\ClickTracking;
use SendGrid\Mail\Ganalytics;
use SendGrid\Mail\OpenTracking;
use SendGrid\Mail\SubscriptionTracking;
use SendGrid\Mail\TrackingSettings;

/**
 * This class tests TrackingSettings.
 *
 * @package SendGrid\Tests
 */
class TrackingSettingsTest extends TestCase {

  public function testConstructor(): void {
    $trackingSettings = new TrackingSettings(
      new ClickTracking(TRUE, TRUE),
      new OpenTracking(TRUE, 'sub_tag'),
      new SubscriptionTracking(TRUE, 'text', '<p>html_text</p>', 'sub_tag'),
      new Ganalytics(TRUE)
    );

    $this->assertTrue($trackingSettings->getClickTracking()->getEnableText());
    $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
    $this->assertTrue($trackingSettings->getSubscriptionTracking()
      ->getEnable());
    $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
  }

  public function testSetClickTracking(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setClickTracking(TRUE, TRUE);

    $this->assertTrue($trackingSettings->getClickTracking()->getEnable());
  }

  public function testSetClickTrackingOnInstance(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setClickTracking(new ClickTracking(TRUE, TRUE));

    $this->assertTrue($trackingSettings->getClickTracking()->getEnable());
  }

  public function testSetOpenTracking(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setOpenTracking(TRUE);

    $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
  }

  public function testSetOpenTrackingOnOpenTrackingInstance(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setOpenTracking(new OpenTracking(TRUE));

    $this->assertTrue($trackingSettings->getOpenTracking()->getEnable());
  }

  public function testSetSubscriptionTracking(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setSubscriptionTracking(TRUE);

    $this->assertTrue($trackingSettings->getSubscriptionTracking()
      ->getEnable());
  }

  public function testSetSubscriptionTrackingOnSubscriptionTrackingInstance(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setSubscriptionTracking(new SubscriptionTracking(TRUE));

    $this->assertTrue($trackingSettings->getSubscriptionTracking()
      ->getEnable());
  }

  public function testSetGanalytics(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setGanalytics(TRUE);

    $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
  }

  public function testSetGanalyticsOnGanalyticsInstance(): void {
    $trackingSettings = new TrackingSettings();
    $trackingSettings->setGanalytics(new Ganalytics(TRUE));

    $this->assertTrue($trackingSettings->getGanalytics()->getEnable());
  }
}
