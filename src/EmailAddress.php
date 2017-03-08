<?php
/**
 * Created by PhpStorm.
 * User: bowens
 * Date: 15/12/16
 * Time: 23:05
 */

namespace SendGrid;


class EmailAddress {

  public
    $name,
    $email;

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
      ]
    );
  }
}