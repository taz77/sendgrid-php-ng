<?php
declare(strict_types=1);
/**
 * Assert class unit tests.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Helper\Assert;
use stdClass;

class AssertTest extends TestCase {

  public function testStringThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be a string. Got: ');

    Assert::string(FALSE, 'test');
  }

  public function testStringThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::string(FALSE, 'test', 'Custom message');
  }

  public function testStringWithCorrectValue(): void {
    Assert::string('test', 'test');

    $this->assertTrue(TRUE);
  }

  public function testEmailThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be a valid email address. Got: test');

    Assert::email('test', 'test');
  }

  public function testEmailThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::email('test', 'test', 'Custom message');
  }

  public function testEmailWithCorrectValue(): void {
    Assert::email('test@example.com', 'test');

    $this->assertTrue(TRUE);
  }

  public function testIntegerThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be an integer. Got: test');

    Assert::integer('test', 'test');
  }

  public function testIntegerThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::integer('test', 'test', 'Custom message');
  }

  public function testIntegerWithCorrectValue(): void {
    Assert::integer(64627492, 'test');

    $this->assertTrue(TRUE);
  }

  public function testBooleanThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be a boolean. Got: test');

    Assert::boolean('test', 'test');
  }

  public function testBooleanThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::boolean('test', 'test', 'Custom message');
  }

  public function testBooleanWithCorrectValue(): void {
    Assert::boolean(FALSE, 'test');
    Assert::boolean(TRUE, 'test');

    $this->assertTrue(TRUE);
  }

  public function testIsInstanceOfThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be an instance of "' . static::class . '". Got: test');

    Assert::isInstanceOf('test', 'test', static::class);
  }

  public function testIsInstanceOfThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::isInstanceOf('test', 'test', static::class, 'Custom message');
  }

  public function testIsInstanceOfWithCorrectValue(): void {
    Assert::isInstanceOf(new stdClass(), 'test', stdClass::class);

    $this->assertTrue(TRUE);
  }

  public function testIsArrayThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be an array. Got: test');

    Assert::isArray('test', 'test');
  }

  public function testIsArrayThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::isArray('test', 'test', 'Custom message');
  }

  public function testIsArrayWithCorrectValue(): void {
    Assert::isArray(['test'], 'test');
    Assert::isArray([64627492, 8482842], 'test');

    $this->assertTrue(TRUE);
  }

  public function testIsCallableThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be callable. Got: test');

    Assert::isCallable('test', 'test');
  }

  public function testIsCallableThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::isCallable('test', 'test', 'Custom message');
  }

  public function testIsCallableWithCorrectValue(): void {
    $callback = static function () {
      return TRUE;
    };

    Assert::isCallable($callback, 'test');

    $this->assertTrue(TRUE);
  }

  public function testAcceptThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" is not valid.');

    Assert::accept('test', 'test', static function ($val) {
      return $val === [];
    });
  }

  public function testAcceptThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::accept('test', 'test', static function ($val) {
      return $val === [];
    }, 'Custom message');
  }

  public function testAcceptWithCorrectValue(): void {
    Assert::accept([], 'test', static function ($val) {
      return $val === [];
    });

    $this->assertTrue(TRUE);
  }

  public function testMinItemsThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Number of elements in "$test" can not be less than 5.');

    Assert::minItems([], 'test', 5);
  }

  public function testMinItemsThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::minItems([], 'test', 5, 'Custom message');
  }

  public function testMinItemsWithCorrectValue(): void {
    $range = range(1, 5);

    Assert::minItems($range, 'test', 2);

    $this->assertTrue(TRUE);
  }

  public function testMaxItemsThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Number of elements in "$test" can not be more than 0.');

    Assert::maxItems(['test'], 'test', 0);
  }

  public function testMaxItemsThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::maxItems(['test'], 'test', 0, 'Custom message');
  }

  public function testMaxItemsWithCorrectValue(): void {
    $range = range(1, 2);

    Assert::maxItems($range, 'test', 5);

    $this->assertTrue(TRUE);
  }

  public function testMinValueThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" expected to be at least 5. Got: 3');

    Assert::minValue(3, 'test', 5);
  }

  public function testMinValueThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::minValue(3, 'test', 5, 'Custom message');
  }

  public function testMinValueWithCorrectValue(): void {
    Assert::minValue(5, 'test', 2);

    $this->assertTrue(TRUE);
  }

  public function testMaxValueThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" expected to be at most 3. Got: 5');

    Assert::maxValue(5, 'test', 3);
  }

  public function testMaxValueThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::maxValue(5, 'test', 3, 'Custom message');
  }

  public function testMaxValueWithCorrectValue(): void {
    Assert::maxValue(2, 'test', 5);

    $this->assertTrue(TRUE);
  }

  public function testMinLengthThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must have at least 5 characters. Got: 4');

    Assert::minLength('test', 'test', 5);
  }

  public function testMinLengthThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::minLength('test', 'test', 5, 'Custom message');
  }

  public function testMinLengthWithCorrectValue(): void {
    Assert::minLength('test', 'test', 2);

    $this->assertTrue(TRUE);
  }

  public function testMaxLengthThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must have no more than 3 characters. Got: 4');

    Assert::maxLength('test', 'test', 3);
  }

  public function testMaxLengthThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::maxLength('test', 'test', 3, 'Custom message');
  }

  public function testMaxLengthWithCorrectValue(): void {
    Assert::maxLength('test', 'test', 5);

    $this->assertTrue(TRUE);
  }

  public function testAnyOfThrowExceptionWithDefaultMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$test" must be any of "foo, bar". Got: test');

    Assert::anyOf('test', 'test', ['foo', 'bar']);
  }

  public function testAnyOfThrowExceptionWithCustomMessage(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('Custom message');

    Assert::anyOf('test', 'test', ['foo', 'bar'], 'Custom message');
  }

  public function testAnyOfWithCorrectValue(): void {
    Assert::anyOf(3, 'test', [1, 3, 5]);

    $this->assertTrue(TRUE);
  }
}
