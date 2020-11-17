<?php
declare(strict_types=1);
/**
 * This file tests GroupId.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\GroupId;

/**
 * This file tests GroupId.
 *
 * @package SendGrid\Tests
 */
class GroupIdTest extends TestCase {

  public function testConstructor(): void {
    $groupId = new GroupId(123456);
    $this->assertSame(123456, $groupId->getGroupId());
  }

  public function testSetGroupId(): void {
    $groupId = new GroupId(123456);
    $groupId->setGroupId(123456);
    $this->assertSame(123456, $groupId->getGroupId());
  }

  public function testSetGroupIdOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$group_id" must be an integer.');
    $groupId = new GroupId();
    $groupId->setGroupId('invalid_group_id');
  }

  public function testJsonSerialize(): void {
    $groupId = new GroupId();
    $groupId->setGroupId(123456);
    $this->assertSame(123456, $groupId->jsonSerialize());
  }
}
