<?php
/**
 * API specific integration
 */

namespace SendGrid;


class API {

  public $api_key,
    $api_key_id;

  public function __construct() {
    $this->api_key = NULL;
    $this->api_key_id = NULL;
  }

}