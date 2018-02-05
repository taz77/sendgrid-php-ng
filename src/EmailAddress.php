<?php
/**
 * Create the email address object serialized for V3 API of SendGrid.
 *
 * @author Brady Owens
 * @package SendGrid
 *
 */

namespace Fastglass\SendGrid;


class EmailAddress implements \JsonSerializable {

  private $name;

  private $email;

  public function __construct($name, $email) {
    $this->name = $name;
    $this->email = $email;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getName() {
    return $this->name;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getEmail() {
    return $this->email;
  }

  public function jsonSerialize() {
    return array_filter(
      [
        'name' => $this->getName(),
        'email' => $this->getEmail(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}