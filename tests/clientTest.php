<?php

namespace SendGrid\Tests;

use \Mockery as m;
use Fastglass\SendGrid as s;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use PHPUnit\Framework\TestCase;

class clientTest extends TestCase {

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
    $this->assertEquals(s\Client::VERSION, '2.0.0');
    $this->assertEquals(json_decode(file_get_contents('composer.json'))->version, s\Client::VERSION);
  }

  /**
   * Test initializing client with API key.
   */
  public function testInitWithApiKey() {
    $sendgrid = new s\Client('token123456789');
    $this->assertEquals('Fastglass\SendGrid\Client', get_class($sendgrid));
    $this->assertEquals($sendgrid->apiKey, 'token123456789');
  }

  /**
   * Test initializing client with API key and options.
   */
  public function testInitWithApiKeyOptions() {
    $sendgrid = new s\Client('token123456789', ['foo' => 'bar']);
    $this->assertEquals('Fastglass\SendGrid\Client', get_class($sendgrid));
  }

  /**
   * Test initializing client with API key with a proxy specified.
   */
  public function testInitWithProxyOption() {
    // Create a mock response to exercise the client against.
    $mock = new MockHandler([
      new Response(200, ['X-Foo' => 'Bar']),
    ]);
    $handler = HandlerStack::create($mock);

    $sendgrid = new s\Client('token123456789', [
      'proxy' => ['http' => 'http://myproxy.net:3128'],
      'handler' => $handler,
      ]);
    $this->assertEquals('SendGrid\Client', get_class($sendgrid));

    // Send the request to the mock interface and see if the proxy was set.
    $email = new s\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(['p1@mailinator.com'], $email->to);

    $email->addTo('p2@mailinator.com');
    $email->setText('This is a mocked email message.');

    $sendgrid->send($email);
    $headeroptions = $sendgrid->getOptions();
    $this->assertEquals('http://myproxy.net:3128', $headeroptions['proxy']['http']);
  }

  /**
   * Test the default URL being returned by the client.
   */
  public function testDefaultURL() {
    $sendgrid = new s\Client('token123456789');
    $this->assertEquals('https://api.sendgrid.com', $sendgrid->url);
  }

  /**
   * Test the default endpoint being returned by the client.
   */
  public function testDefaultEndpoint() {
    $sendgrid = new s\Client('token123456789');
    $this->assertEquals('/v3/mail/send', $sendgrid->endpoint);
  }

  /**
   * Test creating a client with SSL verification turned off.
   */
  public function testSwitchOffSSLVerification() {
    $sendgrid = new s\Client('token123456789', ['turn_off_ssl_verification' => TRUE]);
    $options = $sendgrid->getOptions();
    $this->assertTrue(isset($options['turn_off_ssl_verification']));
  }

  /**
   * Test to make sure an exception is thrown when a non-200 response is returned.
   * This test is currently not working.
   *
   * @todo fix this test
   * @expectedException Fastglass\SendGrid\Exception
   *
  public function testSendGridExceptionThrownWhenNot200() {
    $mockResponse = (object) [
      'code' => 400,
      'raw_body' => "{'message': 'error', 'errors': ['Bad username / password']}",
    ];

    $sendgrid = m::mock('SendGrid[postRequest]', ['token123456789']);
    $sendgrid->shouldReceive('postRequest')
      ->once()
      ->andReturn($mockResponse);

    $email = new s\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }*/

  /**
   * Test creating a client and disabling exceptions being thrown.
   * This test is currently not working.
   *
   * @todo fix this test
   *
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

    $email = new s\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }*/

  /**
   * Make sure that exceptions do not get thrown if a 200 response is received.
   * This test is currently not working.
   *
   * @todo fix this test
   *
  public function testSendGridExceptionNotThrownWhen200() {
    $mockResponse = (object) [
      'code' => 200,
      'body' => (object) ['message' => 'success'],
    ];

    $sendgrid = m::mock('SendGrid[postRequest]', ['token123456789']);
    $sendgrid->shouldReceive('postRequest')
      ->once()
      ->andReturn($mockResponse);

    $email = new s\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
  }*/
}

