<?php
/**
 * This helper builds the SandBoxMode object for a /mail/send API call
 */

namespace SendGrid\Mail;

use JsonSerializable;
use SendGrid\Exception\SendgridException;
use SendGrid\Helper\Assert;

/**
 * This class is used to construct a SandBoxMode object for the /mail/send API
 * call
 *
 * @package SendGrid\Mail
 */
class SandBoxMode implements JsonSerializable {

  /**
   * @var bool Indicates if this setting is enabled
   */
  private $enable;

  /**
   * Optional constructor
   *
   * @param bool|null $enable Indicates if this setting is enabled
   *
   * @throws SendgridException
   */
  public function __construct($enable = NULL) {
    if (isset($enable)) {
      $this->setEnable($enable);
    }
  }

  /**
   * Update the enable setting on a SandBoxMode object
   *
   * @param bool $enable Indicates if this setting is enabled
   *
   * @throws SendgridException
   */
  public function setEnable($enable) {
    Assert::boolean($enable, 'enable');

    $this->enable = $enable;
  }

  /**
   * Retrieve the enable setting on a SandBoxMode object
   *
   * @return bool
   */
  public function getEnable() {
    return $this->enable;
  }

  /**
   * Return an array representing a SandBoxMode object for the Twilio SendGrid
   * API
   *
   * @return null|array
   */
  public function jsonSerialize() :mixed {
    return array_filter(
      [
        'enable' => $this->getEnable(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}
