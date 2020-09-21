<?php

namespace SendGrid\SendgridException;

use Exception;
use SendGrid\SendgridThrowable;

/**
 * Class Exception
 *
 * An exception thrown when SendGrid does not return a 200.
 *
 * @package SendGrid
 */
class SendgridException extends \Exception implements SendgridThrowable {

  public function getMessage() {
    // TODO: Implement getMessage() method.
  }

  public function getCode() {
    // TODO: Implement getCode() method.
  }

  public function getFile() {
    // TODO: Implement getFile() method.
  }

  public function getLine() {
    // TODO: Implement getLine() method.
  }

  public function getTrace() {
    // TODO: Implement getTrace() method.
  }

  public function getTraceAsString() {
    // TODO: Implement getTraceAsString() method.
  }

  public function getPrevious() {
    // TODO: Implement getPrevious() method.
  }

  public function __toString() {
    // TODO: Implement __toString() method.
  }
}
