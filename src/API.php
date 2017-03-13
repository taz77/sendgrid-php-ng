<?php
/**
 * API specific integration
 */

namespace SendGrid;

use \Client;
use \Exception;
use \Response;
use GuzzleHttp\Exception\ClientException;

class API {

  public $api_key,
    $api_key_id;

  public function __construct() {
    $this->api_key = NULL;
    $this->api_key_id = NULL;
  }

  public function getApiKeys() {
    $client = new \Client($this->api_key);

  }

}