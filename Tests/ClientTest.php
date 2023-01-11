<?php
declare(strict_types=1);

/**
 * Simple Unit tests of the client.
 */

namespace SendGrid\Tests;

use SendGrid\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase {

  /**
   * Test the version number.
   */
  public function testVersion(): void {
    $this->assertEquals(Client::VERSION, '2.0.6');
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, \SendGrid\Client::VERSION);
  }

  /**
   * Test creating a client with SSL verification turned off.
   */
  public function testSwitchOffSSLVerification(): void {
    $sendgrid = new Client('token123456789', ['turn_off_ssl_verification' => TRUE]);
    $options = $sendgrid->getOptions();
    $this->assertTrue(isset($options['turn_off_ssl_verification']));
  }

}

