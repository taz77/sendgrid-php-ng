<?php

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;

class exceptionTest extends TestCase {

  public function tearDown() {
  }

  public function testConstructionException() {
    $err = new \SendGrid\Exception();
    $this->assertEquals(get_class($err), 'SendGrid\Exception');
  }

}
