<?php

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception;

class exceptionTest extends TestCase {

  public function tearDown() {
  }

  public function testConstructionException() {
    $err = new Exception();
    $this->assertEquals(get_class($err), 'SendGrid\Exception');
  }

}
