<?php
declare(strict_types=1);
/**
 * This file tests the existence of necessary files in this repo.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;

/**
 * This class tests the existence of necessary files in this repo.
 *
 * @package SendGrid\Tests
 */
class FilesExistTest extends TestCase {

  /**
   * This method tests that the required files exist in the repo
   */
  public function testFilesArePresentInRepo(): void {
    $rootDir = __DIR__ . '/..';
    $this->assertFileExists("$rootDir/.gitignore");
    $this->assertFileExists("$rootDir/.github/workflows/php.yml");
    $this->assertFileExists("$rootDir/CHANGELOG.md");
    $this->assertFileExists("$rootDir/MIT.LICENSE");
    $this->assertFileExists("$rootDir/composer.json");
    $this->assertFileExists("$rootDir/README.md");
  }
}
