<?php

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Response;

class responseTest extends TestCase {

  public function tearDown() {
  }

  public function testConstructionResponse() {
    $res = new Response(200, 'headers', 'raw_body', 'body');
    $this->assertEquals(get_class($res), 'SendGrid\Response');
  }

  public function testPublicAttributes() {
    $res = new Response(200, 'headers', 'raw_body', 'body');
    $this->assertEquals($res->code, 200);
    $this->assertEquals($res->headers, 'headers');
    $this->assertEquals($res->raw_body, 'raw_body');
    $this->assertEquals($res->body, 'body');
  }

  public function testGetters() {
    $res = new Response(200, 'headers', 'raw_body', 'body');
    $this->assertEquals($res->getCode(), 200);
    $this->assertEquals($res->getHeaders(), 'headers');
    $this->assertEquals($res->getRawBody(), 'raw_body');
    $this->assertEquals($res->getBody(), 'body');
  }

}
