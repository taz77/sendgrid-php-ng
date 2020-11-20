<?php
declare(strict_types=1);
/**
 * This file tests Category.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\Category;
use SendGrid\Exception\TypeException;

/**
 * This file tests Category.
 *
 * @package SendGrid\Tests
 */
class CategoryTest extends TestCase {

  public function testConstructor(): void {
    $category = new Category('category');

    $this->assertInstanceOf(Category::class, $category);
    $this->assertSame('category', $category->getCategory());
  }

  public function testSetCategory(): void {
    $category = new Category();
    $category->setCategory('category');

    $this->assertSame('category', $category->getCategory());
  }
  
  public function testSetCategoryOnInvalidType(): void {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage('"$category" must be a string.');
    $category = new Category();
    $category->setCategory(['invalid_category']);
  }

  public function testJsonSerialize(): void {
    $category = new Category();
    $category->setCategory('category');

    $this->assertSame('category', $category->jsonSerialize());
  }
}
