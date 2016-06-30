<?php

namespace SendGrid\Tests;

class SendGridTest_Web extends \PHPUnit_Framework_TestCase {

  public function testConstruction() {
    $sendgrid = new \SendGrid\Client('token123456789');
    $this->assertEquals(new \SendGrid\Client('token123456789'), $sendgrid);
    $this->assertEquals(get_class($sendgrid), 'SendGrid\Client');
  }

  public function testSendResponse() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('bar@foo.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('foo@bar.com');

    try {
      $response = $sendgrid->send($email);
    }
    catch (\GuzzleHttp\Exception\ClientException $e) {
      $responseBody = $e->getResponse()->getBody(TRUE);
    }


    $this->assertEquals('The provided authorization grant is invalid, expired, or revoked', $responseBody);
  }

  public function testSendResponseWithAttachment() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/gif.gif');

    $response = $sendgrid->send($email);

    $this->assertEquals('Bad username / password', $response->errors[0]);
  }

  public function testSendResponseWithAttachmentMissingExtension() {
    $sendgrid = new \SendGrid\Client('token123456789');

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);

    $this->assertEquals('Bad username / password', $response->errors[0]);
  }

  public function testSendResponseWithSslOptionFalse() {
    $sendgrid = new \SendGrid\Client('token123456789', ['switch_off_ssl_verification' => TRUE]);

    $email = new \SendGrid\Email();
    $email->setFrom('p1@mailinator.com')
      ->setSubject('foobar subject')
      ->setText('foobar text')
      ->addTo('p1@mailinator.com')
      ->addAttachment('./tests/text');

    $response = $sendgrid->send($email);

    $this->assertEquals('Bad username / password', $response->errors[0]);

  }
}
