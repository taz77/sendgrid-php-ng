<?php
declare(strict_types=1);
/**
 * This file tests IpPoolName.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\IpPoolName;

/**
 * This file tests IpPoolName.
 *
 * @package SendGrid\Tests
 */
class IpPoolNameTest extends TestCase {

  public function testConstructor() {
    $ipPoolName = new IpPoolName('127.0.0.1');
    $this->assertInstanceOf(IpPoolName::class, $ipPoolName);
    $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
  }

  public function testSetIpPoolNme() {
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName('127.0.0.1');
    $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
  }

  public function testSetIpPoolNmeOnInvalidType() {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$ip_pool_name" must be a string.');
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName(['127.0.0.1']);
  }

  public function testJsonSerialize() {
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName('127.0.0.1');
    $this->assertSame('127.0.0.1', $ipPoolName->jsonSerialize());
  }
}
