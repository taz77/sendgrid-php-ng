<?php

use SendGrid\Client;

/**
 * This library allows you to quickly and easily send emails through Twilio
 * SendGrid using PHP.
 *
 * @package SendGrid\Mail
 */
class SendGrid extends Client
{
  /**
   * Set up the HTTP Client.
   *
   * @param string $apiKey Your Twilio SendGrid API Key.
   * @param array $options An array of options supported by the Guzzle HTTP
   *                       client. All aspects of the client connection can be
   *                       overridden here.
   */
  public function __construct($apiKey, $options = array())
  {
    parent::__construct($apiKey, $options);
  }
}
