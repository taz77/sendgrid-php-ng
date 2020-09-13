<?php

/**
 * Create the client for V3 API of SendGrid.
 *
 * @author Brady Owens
 * @copyright 2020 Fastglass LLC
 * @package SendGrid
 * @license https://opensource.org/licenses/MIT
 * @link https://packagist.org/packages/fastglass/sendgrid
 *
 */

namespace SendGrid\Mail;


class Content implements \\JsonSerializable {

  private $type;

  private $value;

  public function __construct($type, $value) {
    $this->type = $type;
    $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
  }

  public function setType($type) {
    $this->type = $type;
  }

  public function getType() {
    return $this->type;
  }

  public function setValue($value) {
    $this->value = mb_convert_encoding($value, 'UTF-8', 'UTF-8');
  }

  public function getValue() {
    return $this->value;
  }

  public function jsonSerialize() {
    return array_filter(
      [
        'type' => $this->getType(),
        'value' => $this->getValue(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}