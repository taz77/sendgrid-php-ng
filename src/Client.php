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


namespace SendGrid;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\HandlerStack;
use SendGrid\Exception\SendgridException;
use SendGrid\Mail\Mail;

/**
 * Class SendGrid
 */
class Client {

  const VERSION = '2.0.0';

  protected
    $headers = ['Content-Type' => 'application/json'],
    $options;

  public
    $apiKey,
    $client,
    $url,
    $endpoint,
    $version = self::VERSION;

  /**
   * SendGrid constructor.
   *
   * @param string $apiKey
   * @param array $options
   *
   * @throws string
   */
  public function __construct($apiKey, $options = []) {
    // API key.
    $this->apiKey = $apiKey;

    $this->options['turn_off_ssl_verification'] = (isset($this->options['turn_off_ssl_verification']) && $this->options['turn_off_ssl_verification'] == TRUE);
    if (!isset($this->options['raise_exceptions'])) {
      $this->options['raise_exceptions'] = TRUE;
    }

    // Default to https protocol.
    $protocol = isset($this->options['protocol']) ? $this->options['protocol'] : 'https';
    // Default to api.sendgrid.com as the host.
    $host = isset($this->options['host']) ? $this->options['host'] : 'api.sendgrid.com';
    // Default to no port number.
    $port = isset($this->options['port']) ? $this->options['port'] : '';

    // Set the options in the object for the class.
    $this->options = $options;

    if (!empty($options['proxy'])) {
      $this->proxy = $options['proxy'];
    }

    // Construct the URL for the Sendgrid Service.
    $this->url = isset($this->options['url']) ? $this->options['url'] : $protocol . '://' . $host . ($port ? ':' . $port : '');
    // Construct the endpoint URL.
    $this->endpoint = isset($this->options['endpoint']) ? $this->options['endpoint'] : '/v3/mail/send';

    $this->client = $this->prepareHttpClient();
  }

  /**
   * Prepares the HTTP client
   *
   * @return \GuzzleHttp\Client
   */
  private function prepareHttpClient() {
    $headers = [];
    // Set the API key header for the request.
    $headers['Authorization'] = 'Bearer' . ' ' . $this->apiKey;

    // Using http proxy
    if (isset($this->options['proxy'])) {
      $headers['proxy'] = $this->options['proxy'];
    }
    $headers['User-Agent'] = 'sendgrid/' . $this->version . ';php';
    // Create an empty stack for error processing.
    // Guzzlehttp will choose the most appropriate handler based on the system.
    if (empty($this->options['handler'])) {
      $stack = HandlerStack::create();
    }
    else {
      $stack = $this->options['handler'];
    }
    $client = new \GuzzleHttp\Client([
      'base_uri' => $this->url,
      'handler' => $stack,
      'headers' => $headers,
    ]);
    return $client;
  }

  /**
   * Return the options set in the Sendgrid object. Returns and array of
   * protected options.
   *
   * @return array $this->options
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * Makes a post request to SendGrid to send an email from an email object.
   * Returns response codes after sending and will throw exceptions on faults.
   *
   * @param Mail $email
   *
   * @return \SendGrid\Response
   * @throws SendgridException
   */
  public function send(Mail $email) {

    // Adding API keys to header.
    // $form['api_key'] = $this->apiKey;
    $response = $this->postRequest($this->endpoint, $email);

    if ($response->getCode() != 200) {
      throw new SendgridException($response->getRawBody(), $response->getCode());
    }

    return $response;
  }

  /**
   * Makes the actual HTTP request to SendGrid using Guzzle. The form is an
   * array of ready options for SendGrid email.
   *
   * @param string $endpoint
   * @param Mail $email
   *
   * @return \SendGrid\Response
   */
   private function postRequest($endpoint, $email) {
    $requestoptions = [];

    // Add email project to request as json.
    $requestoptions['json'] = json_encode($email);

    // Allow for contection timeout.
    if (isset($this->options['connect_timeout'])) {
      $requestoptions['connect_timeout'] = $this->options['connect_timeout'];
    }

    // Allow for request timeout.
    if (isset($this->options['timeout'])) {
      $requestoptions['timeout'] = $this->options['timeout'];
    }

    // Proxy settings
    if (isset($this->options['proxy'])) {
      $requestoptions['proxy'] = $this->options['proxy'];
    }

    try {
      $res = $this->client->request('POST', $endpoint, $requestoptions);
    }
    catch (RequestException $e) {
      // Guzzle returns PRS-7 meessages for all responses.
      $res =  $e->getResponse();
    }
     return new Response($res->getStatusCode(), $res->getHeaders(), $res->getBody(), json_decode($res->getBody()));
  }

  /**
   * Prepare a request to be submitted as multipart.
   *
   * @param array $data
   *
   * @return array $message
   */
  public function prepareMultipart($data) {
    // The contents of the multipart request.
    $message = [];
    foreach ($data as $key => $value) {
      // If the value is an array we have to perform a hack to handle array values.
      if (is_array($value) && $key != 'files') {
        foreach ($value as $item) {
          $message[] = [
            'name' => $key . '[]',
            'contents' => $item,
          ];
        }
      }
      // If the item is the files, we build a special array to include
      // the filenames as the indicies.
      elseif (is_array($value) && $key == 'files') {
        foreach ($value as $filekey => $filevalue) {
          // Guzzle 6.x requires passing a file with an fopen resource
          $message[] = [
            'name' => 'files[' . $filekey . ']',
            'contents' => fopen($filevalue, 'r'),
            'filename' => $filekey,
          ];

        }
      }
      else {
        $message[] = [
          'name' => $key,
          'contents' => $value,
        ];
      }
    }
    return $message;
  }
}
