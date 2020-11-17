<?php

namespace SendGrid\Tests;

class SendGridTest_Web extends \PHPUnit\Framework\TestCase {

  public function testConstruction() {
    $sendgrid = new \SendGrid\Client('token123456789');
    $this->assertEquals(new \SendGrid\Client('token123456789'), $sendgrid);
    $this->assertEquals(get_class($sendgrid), 'SendGrid\Client');
  }

  /**
   * Test sending a request with bad credentials returns false whe no exceptions are enabled.
   *
   */
  public function testSendResponseReturnsFalseWhenNoException() {
    $sendgrid = new \SendGrid\Client('token123456789', ['raise_exceptions' => FALSE]);

    $email = new \SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $response = $sendgrid->send($email);
    $this->assertInstanceOf(\SendGrid\Response::class, $response);
    $this->assertEquals(400, $response->getCode());
    $this->assertEquals('{"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}', (string) $response->getRawBody());
  }

  /**
   * Test sending a request with bad credentials and attachment.
   */
  public function testSendResponseWithAttachmentReturnsFalseWhenNoException() {
    $sendgrid = new \SendGrid\Client('token123456789', ['raise_exceptions' => FALSE]);

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/gif.gif');

    $response = $sendgrid->send($email);
    $this->assertInstanceOf(\SendGrid\Response::class, $response);
    $this->assertEquals(400, $response->getCode());
    $this->assertEquals('{"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}', (string) $response->getRawBody());
  }

  /**
   * Test sending a request with bad credentials and attachment missing
   * extension.
   */
  public function testSendResponseWithAttachmentMissingExtensionReturnsFalseWhenNoException() {
    $sendgrid = new \SendGrid\Client('token123456789', ['raise_exceptions' => FALSE]);

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);
    $this->assertInstanceOf(\SendGrid\Response::class, $response);
    $this->assertEquals(400, $response->getCode());
    $this->assertEquals('{"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}', (string) $response->getRawBody());
  }

  /**
   * Test sending a request with bad credentials and SSL verification off.
   */
  public function testSendResponseWithSslOptionFalseReturnsFalseWhenNoException() {
    $sendgrid = new \SendGrid\Client('token123456789', ['raise_exceptions' => FALSE]);

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);
    $this->assertInstanceOf(\SendGrid\Response::class, $response);
    $this->assertEquals(400, $response->getCode());
    $this->assertEquals('{"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}', (string) $response->getRawBody());
  }

  /**
   * Test sending a request with bad credentials.
   *
   * @expectedException \SendGrid\Exception
   * @expectedExceptionMessage  {"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}
   */
  public function testSendResponse() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    $sendgrid->send($email);
  }

  /**
   * Test sending a request with bad credentials and attachment.
   *
   * @expectedException \SendGrid\Exception
   * @expectedExceptionMessage  {"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}
   */
  public function testSendResponseWithAttachment() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/gif.gif');

    $response = $sendgrid->send($email);
    $this->assertFalse($response);
  }

  /**
   * Test sending a request with bad credentials and attachment missing
   * extension.
   *
   * @expectedException \SendGrid\Exception
   * @expectedExceptionMessage  {"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}
   */
  public function testSendResponseWithAttachmentMissingExtension() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);
    $this->assertFalse($response);
  }

  /**
   * Test sending a request with bad credentials and SSL verification off.
   *
   * @expectedException \SendGrid\Exception
   * @expectedExceptionMessage  {"errors":["The provided authorization grant is invalid, expired, or revoked"],"message":"error"}
   */
  public function testSendResponseWithSslOptionFalse() {
    $sendgrid = new \SendGrid\Client('token123456789', ['switch_off_ssl_verification' => TRUE]);

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);
    $this->assertFalse($response);
  }
}
