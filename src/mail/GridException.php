<?php

namespace SendGrid\Mail;

use Exception;

/**
 * Class Exception
 *
 * An exception thrown when SendGrid does not return a 200.
 *
 * @package SendGrid
 */
class GridException extends Exception {

  public function getErrors() {
    return json_decode($this->message)->errors;
  }
}
