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

  public function testConstructor(): void {
    $ipPoolName = new IpPoolName('127.0.0.1');
    $this->assertInstanceOf(IpPoolName::class, $ipPoolName);
    $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
  }

  public function testSetIpPoolNme(): void {
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName('127.0.0.1');
    $this->assertSame('127.0.0.1', $ipPoolName->getIpPoolName());
  }

  public function testSetIpPoolNmeOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$ip_pool_name" must be a string.');
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName(['127.0.0.1']);
  }

  public function testJsonSerialize(): void {
    $ipPoolName = new IpPoolName();
    $ipPoolName->setIpPoolName('127.0.0.1');
    $this->assertSame('127.0.0.1', $ipPoolName->jsonSerialize());
  }
}
