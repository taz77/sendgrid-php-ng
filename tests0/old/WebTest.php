<?php

namespace SendGrid\Tests;

use GuzzleHttp\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use SendGrid\Client;
use SendGrid\Email;

class webTest extends TestCase {

  public function testConstruction() {
    $sendgrid = new Client('token123456789');
    $this->assertEquals(new Client('token123456789'), $sendgrid);
    $this->assertEquals(get_class($sendgrid), 'SendGrid\Client');
  }

  /**
   * Test sending a request with bad credentials.
   */
  public function testSendResponse() {
    $sendgrid = new Client('token123456789');

    $email = new Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');
    try {
      $response = $sendgrid->send($email);
    }
    catch (ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
    }
    $this->assertContains('The provided authorization grant is invalid, expired, or revoked', $responseBodyAsString);
  }

  /**
   * Test sending a request with bad credentials and attachment.
   */
  public function testSendResponseWithAttachment() {
    $sendgrid = new Client('token123456789');

    $email = new Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/gif.gif');
    try {
      $response = $sendgrid->send($email);
    }
    catch (ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
    }
    $this->assertContains('The provided authorization grant is invalid, expired, or revoked', $responseBodyAsString);
  }

  /**
   * Test sending a request with bad credentials and attachment missing
   * extension.
   */
  public function testSendResponseWithAttachmentMissingExtension() {
    $sendgrid = new Client('token123456789');

    $email = new Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');
    try {
      $response = $sendgrid->send($email);
    }
    catch (ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
    }
    $this->assertContains('The provided authorization grant is invalid, expired, or revoked', $responseBodyAsString);
  }

  /**
   * Test sending a request with bad credentials and SSL verification off.
   */
  public function testSendResponseWithSslOptionFalse() {
    $sendgrid = new Client('token123456789', ['switch_off_ssl_verification' => TRUE]);

    $email = new Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');
    try {
      $response = $sendgrid->send($email);
    }
    catch (ClientException $e) {
      $response = $e->getResponse();
      $responseBodyAsString = $response->getBody()->getContents();
    }
    $this->assertContains('The provided authorization grant is invalid, expired, or revoked', $responseBodyAsString);
  }
}
