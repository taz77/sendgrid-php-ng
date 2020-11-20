<?php
declare(strict_types=1);

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Exception\TypeException;
use SendGrid\Mail\Substitution;

/**
 * This file tests Substitutions.
 *
 * @package SendGrid\Tests
 */
class SubstitutionTest extends TestCase {

  public function testSubstitutionSetValue(): void {
    $substitution = new Substitution();
    $testString = 'Twilio SendGrid is awesome!';
    $testArray = ['one', 'two', 'three'];
    $testObject = (object) ['1' => 'foo'];
    $testNumberInt = 1;
    $testNumberFloat = 1.0;
    $testInvalidInput = NULL;

    $substitution->setValue($testString);
    $this->assertEquals($substitution->getValue(), $testString);
    $substitution->setValue($testArray);
    $this->assertEquals($substitution->getValue(), $testArray);
    $substitution->setValue($testObject);
    $this->assertEquals($substitution->getValue(), $testObject);
    $substitution->setValue($testNumberInt);
    $this->assertEquals($substitution->getValue(), $testNumberInt);
    $substitution->setValue($testNumberFloat);
    $this->assertEquals($substitution->getValue(), $testNumberFloat);
    $this->expectException('SendGrid\Exception\TypeException');
    $substitution->setValue($testInvalidInput);
  }

  public function testConstructor(): void {
    $substitution = new Substitution('key', 'value');
    $this->assertInstanceOf(Substitution::class, $substitution);
    $this->assertSame('key', $substitution->getKey());
    $this->assertSame('value', $substitution->getValue());
  }

  public function testSetKey(): void {
    $substitution = new Substitution();
    $substitution->setKey('key');
    $this->assertSame('key', $substitution->getKey());
  }

  public function testSetKeyOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$key" must be a string');
    $substitution = new Substitution();
    $substitution->setKey(TRUE);
  }

  public function testSetValue(): void {
    $substitution = new Substitution();
    $substitution->setValue('key');
    $this->assertSame('key', $substitution->getValue());
  }

  public function testSetValueOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$value" must be an array, object, boolean, string, numeric or integer.');
    $substitution = new Substitution();
    $substitution->setValue(NULL);
  }
}
