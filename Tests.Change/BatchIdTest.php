<?php
declare(strict_types=1);
/**
 * This file tests BatchId.
 */

namespace SendGrid\Tests;

use PHPUnit\Framework\TestCase;
use SendGrid\Mail\BatchId;
use \SendGrid\Exception\TypeException;

/**
 * This file tests BatchId.
 *
 * @package SendGrid\Tests
 */
class BatchIdTest extends TestCase {

  public function testConstructor(): void {
    $batchId = new BatchId('this_is_batch_id');

    $this->assertInstanceOf(BatchId::class, $batchId);
    $this->assertSame('this_is_batch_id', $batchId->getBatchId());
  }

  public function testSetBatchId(): void  {
    $batchId = new BatchId();
    $batchId->setBatchId('this_is_batch_id');

    $this->assertSame('this_is_batch_id', $batchId->getBatchId());
  }

  public function testSetBatchIdOnInvalidBatchId(): void  {
    $this->expectException(TypeException::class);
    $this->expectExceptionMessage("\"\$batch_id\" must be a string.");
    $batch_id = new BatchId();
    $batch_id->setBatchId(['invalid_batch_id']);
  }

  public function testJsonSerialize(): void  {
    $batchId = new BatchId();

    $this->assertNull($batchId->jsonSerialize());
  }
}
