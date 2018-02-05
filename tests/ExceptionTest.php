<?php

namespace Fastglass\SendGrid\Tests;

use PHPUnit\Framework\TestCase;

class exceptionTest extends TestCase {

  public function tearDown() {
  }

  public function testConstructionException() {
    $err = new \Fastglass\SendGrid\Exception();
    $this->assertEquals(get_class($err), 'SendGrid\Exception');
  }

}
