<?php

use \Mockery as m;

class SendGridTest_SendGrid extends PHPUnit_Framework_TestCase {

  /**
   * Tear down test.
   */
  public function tearDown() {
    m::close();
  }

  /**
   * Test the version number.
   */
  public function testVersion() {
    $this->assertEquals(SendGrid\Client::VERSION, '1.0.4');
    $this->assertEquals(json_decode(file_get_contents('../composer.json'))->version, SendGrid\Client::VERSION);
  }

  public function testInitWithApiKey() {
    $sendgrid = new SendGrid\Client('token123456789');
    $this->assertEquals('SendGrid', get_class($sendgrid));
    $this->assertNull($sendgrid->apiUser);
    $this->assertEquals($sendgrid->apiKey, 'token123456789');
  }

  public function testInitWithApiKeyOptions() {
    $sendgrid = new SendGrid\Client('token123456789', ['foo' => 'bar']);
    $this->assertEquals('SendGrid', get_class($sendgrid));
  }

  public function testInitWithProxyOption() {
    $sendgrid = new SendGrid\Client('token123456789', ['proxy' => 'myproxy.net:3128']);
    $this->assertEquals('SendGrid', get_class($sendgrid));
    $options = $sendgrid->getOptions();
    $this->assertTrue(isset($options['proxy']));
  }

  public function testDefaultURL() {
    $sendgrid = new SendGrid\Client('token123456789');
    $this->assertEquals('https://api.sendgrid.com', $sendgrid->url);
  }

  public function testDefaultEndpoint() {
    $sendgrid = new SendGrid\Client('token123456789');
    $this->assertEquals('/api/mail.send.json', $sendgrid->endpoint);

  }

  public function testCustomURL() {
    $options = [
      'protocol' => 'http',
      'host' => 'sendgrid.org',
      'endpoint' => '/send',
      'port' => '80',
    ];
    $sendgrid = new SendGrid\Client('token123456789', $options);
    $this->assertEquals('http://sendgrid.org:80', $sendgrid->url);
  }

  public function testSwitchOffSSLVerification() {
    $sendgrid = new SendGrid\Client('token123456789', ['turn_off_ssl_verification' => TRUE]);
    $options = $sendgrid->getOptions();
    $this->assertTrue(isset($options['turn_off_ssl_verification']));
  }

  /**
   * @expectedException SendGrid\Exception
   */
  public function testSendGridExceptionThrownWhenNot200() {
    $mockResponse = (object) [
      'code' => 400,
      'raw_body' => "{'message': 'error', 'errors': ['Bad username / password']}",
    ];

    $sendgrid = m::mock('SendGrid[postRequest]', ['token123456789']);
    $sendgrid->shouldReceive('postRequest')
      ->once()
      ->andReturn($mockResponse);

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }

  public function testDisableSendGridException() {
    $mockResponse = (object) [
      'code' => 400,
      'raw_body' => "{'message': 'error', 'errors': ['Bad username / password']}",
    ];

    $sendgrid = m::mock('SendGrid[postRequest]', [
      'token123456789',
      ['raise_exceptions' => FALSE],
    ]);
    $sendgrid->shouldReceive('postRequest')
      ->once()
      ->andReturn($mockResponse);

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }

  public function testSendGridExceptionNotThrownWhen200() {
    $mockResponse = (object) [
      'code' => 200,
      'body' => (object) ['message' => 'success'],
    ];

    $sendgrid = m::mock('SendGrid[postRequest]', ['token123456789']);
    $sendgrid->shouldReceive('postRequest')
      ->once()
      ->andReturn($mockResponse);

    $email = new SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }
}

