<?php
declare(strict_types=1);
/**
 * GroupsToDisplay class unit tests.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\GroupsToDisplay;

class GroupsToDisplayTest extends TestCase {

  public function testSetGroupsToDisplayWithExceededElementsCount(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');
    $data = range(1, 30);
    $groups = new GroupsToDisplay();
    $groups->setGroupsToDisplay($data);
  }

  public function testAddGroupToDisplayWithAlready(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Number of elements in "$groups_to_display" can not be more than 25.');

    $data = range(1, 25);
    $groups = new GroupsToDisplay($data);
    $groups->addGroupToDisplay(1);
  }

  public function testConstructor(): void {
    $groupsToDisplay = new GroupsToDisplay([123456]);
    $this->assertInstanceOf(GroupsToDisplay::class, $groupsToDisplay);
    $this->assertSame([123456], $groupsToDisplay->getGroupsToDisplay());
  }

  public function testSetGroupsToDisplay(): void {
    $groupsToDisplay = new GroupsToDisplay();
    $groupsToDisplay->setGroupsToDisplay([123456]);

    $this->assertSame([123456], $groupsToDisplay->getGroupsToDisplay());
  }

  public function testSetGroupsToDisplayOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$groups_to_display" must be an array.');
    $groupsToDisplay = new GroupsToDisplay();
    $groupsToDisplay->setGroupsToDisplay('invalid_groups_to_display');
  }

  public function testJsonSerialize(): void {
    $groupsToDisplay = new GroupsToDisplay();
    $groupsToDisplay->setGroupsToDisplay([123456]);
    $this->assertSame([123456], $groupsToDisplay->jsonSerialize());
  }
}
