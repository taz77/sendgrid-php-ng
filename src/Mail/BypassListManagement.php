<?php
/**
 * This helper builds the BypassListManagement object for a /mail/send API call
 */

namespace SendGrid\Mail;

use JsonSerializable;
use SendGrid\Exception\SendgridException;
use SendGrid\Helper\Assert;

/**
 * This class is used to construct a BypassListManagement object for
 * the /mail/send API call
 *
 * Allows you to bypass all unsubscribe groups and suppressions to
 * ensure that the email is delivered to every single recipient. This
 * should only be used in emergencies when it is absolutely necessary
 * that every recipient receives your email
 *
 * @package SendGrid\Mail
 */
class BypassListManagement implements JsonSerializable {

  /** @var $enable bool Indicates if this setting is enabled */
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
   * Update the enable setting on a BypassListManagement object
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
   * Retrieve the enable setting on a BypassListManagement object
   *
   * @return bool
   */
  public function getEnable() {
    return $this->enable;
  }

  /**
   * Return an array representing a BypassListManagement object for
   * the SendGrid API
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
