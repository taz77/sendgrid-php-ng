<?php
declare(strict_types=1);

namespace SendGrid\Tests;

use SendGrid\Client;

/**
 * This class tests the Twilio SendGrid Client.
 *
 * @package SendGrid\Tests
 */
class SendGridTest extends BaseTestClass {

  /**
   * Test that we can connect to the Twilio SendGrid API.
   */
  public function testCanConnectToSendGridApi(): void {
    $sg = new Client(self::$apiKey);
    $headers = [];
    $headers['Authorization'] = 'Bearer ' . self::$apiKey;
    $headers['User-Agent'] = 'sendgrid/' . $sg->version . ';php';
    $this->assertEquals('https://api.sendgrid.com', $sg->client->getConfig('base_uri')
      ->__toString());
    $this->assertEquals($headers, $sg->client->getConfig('headers'));
    $this->assertEquals('/v3/mail/send', $sg->getEndpoint());

    $sg = new Client(self::$apiKey, ['url' => 'https://api.test.com']);
    $this->assertEquals('https://api.test.com', $sg->client->getConfig('base_uri')
      ->__toString());

    $sg = new Client(self::$apiKey, ['proxy' => ['127.0.0.1:8000']]);
    $this->assertEquals('127.0.0.1:8000', $sg->client->getConfig('request.options')['proxy'][0]);
  }

  /**
   * Test that user can override the API version when instantiating a new
   * SendGrid client.
   */
  public function testCanOverridePath(): void {
    $opts['endpoint'] = '/v4';
    $sg = new Client(self::$apiKey, $opts);
    $this->assertEquals('/v4', $sg->getEndpoint());
  }
}
