<?php
/**
 * This helper builds the Substitution object for a /mail/send API call
 */

namespace SendGrid\Mail;

use JsonSerializable;
use SendGrid\Exception\SendgridException;
use SendGrid\Helper\Assert;
use function is_array;
use function is_bool;
use function is_float;
use function is_object;
use function is_string;

/**
 * This class is used to construct a Substitution object for the /mail/send API
 * call
 *
 * A collection of key/value pairs following the pattern
 * "substitution_tag":"value to substitute". All are assumed to be strings.
 * These substitutions will apply to the text and html content of the body of
 * your email, in addition to the subject and reply-to parameters. The total
 * collective size of your substitutions may not exceed 10,000 bytes per
 * personalization object
 *
 * @package SendGrid\Mail
 */
class Substitution implements JsonSerializable {

  /** @var $key string Substitution key */
  private $key;

  /** @var $value string Substitution value */
  private $value;

  /**
   * Optional constructor
   *
   * @param string|null $key Substitution key
   * @param string|null $value Substitution value
   *
   * @throws SendgridException
   */
  public function __construct($key = NULL, $value = NULL) {
    if (isset($key)) {
      $this->setKey($key);
    }
    if (isset($value)) {
      $this->setValue($value);
    }
  }

  /**
   * Add the key on a Substitution object
   *
   * @param string $key Substitution key
   *
   * @throws SendgridException
   */
  public function setKey($key) {
    Assert::string($key, 'key');

    $this->key = $key;
  }

  /**
   * Retrieve the key from a Substitution object
   *
   * @return string
   */
  public function getKey() {
    return $this->key;
  }

  /**
   * Add the value on a Substitution object
   *
   * @param string|array|object|bool|int|float $value Substitution value
   *
   * @throws SendgridException
   */
  public function setValue($value) {
    Assert::accept($value, 'value', static function ($val) {
      return is_string($val)
        || filter_var($val, FILTER_VALIDATE_INT) !== FALSE
        || is_float($val)
        || is_bool($val)
        || is_array($val)
        || is_object($val);
    }, '"$value" must be an array, object, boolean, string, numeric or integer.');

    $this->value = $value;
  }

  /**
   * Retrieve the value from a Substitution object
   *
   * @return string
   */
  public function getValue() {
    return $this->value;
  }

  /**
   * Return an array representing a Substitution object for the Twilio SendGrid
   * API
   *
   * @return null|array
   */
  public function jsonSerialize() :mixed {
    return array_filter(
      [
        'key' => $this->getKey(),
        'value' => $this->getValue(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}
