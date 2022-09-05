<?php
/**
 * This helper builds the BatchId object for a /mail/send API call
 */

namespace SendGrid\Mail;

use JsonSerializable;
use \SendGrid\Exception\TypeException;
use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BatchId object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class BatchId implements JsonSerializable {

  /** @var $batch_id string This ID represents a batch of emails to be sent at the same time */
  private $batch_id;

  /**
   * Optional constructor
   *
   * @param string|null $batch_id This ID represents a batch of emails to
   *                              be sent at the same time
   *
   * @throws TypeException
   */
  public function __construct($batch_id = NULL) {
    if (isset($batch_id)) {
      $this->setBatchId($batch_id);
    }
  }

  /**
   * Add the batch id to a BatchId object
   *
   * @param string $batch_id This ID represents a batch of emails to be sent
   *                         at the same time
   *
   * @throws TypeException
   */
  public function setBatchId($batch_id) {
    Assert::string($batch_id, 'batch_id', '"$batch_id" must be a string.');

    $this->batch_id = $batch_id;
  }

  /**
   * Return the batch id from a BatchId object
   *
   * @return string
   */
  public function getBatchId() {
    return $this->batch_id;
  }

  /**
   * Return an array representing a BatchId object for the Twilio SendGrid API
   *
   * @return null|string
   */
  public function jsonSerialize() :mixed {
    return $this->getBatchId();
  }
}
