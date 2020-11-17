<?php
/**
 * This helper builds theContent object for a /mail/send API call
 */

namespace SendGrid\Mail;

use SendGrid\Exception\SendgridException;

/**
 * This class is used to construct a Content object for the /mail/send API call
 *
 * @package SendGrid\Mail
 */
class PlainTextContent extends Content {

  /**
   * Create a Content object with a plain text mime type
   *
   * @param string $value plain text formatted content
   *
   * @throws SendgridException
   */
  public function __construct($value) {
    parent::__construct(MimeType::TEXT, $value);
  }
}
