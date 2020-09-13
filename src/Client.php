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


namespace Fastglass\SendGrid;

/**
 * Class SendGrid
 */
class Client {

  const VERSION = '2.0.0';

  protected
    $headers = ['Content-Type' => 'application/json'],
    $client,
    $options;

  public
    $apiKey,
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
      $stack = \GuzzleHttp\HandlerStack::create();
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
   * @param SendGrid\Email $email
   *
   * @return SendGrid\Response
   * @throws SendGrid\Exception
   */
  public function send(SendGrid\Email $email) {
    $form = $email->toWebFormat();
    // Adding API keys to header.
    // $form['api_key'] = $this->apiKey;
    $response = $this->postRequest($this->endpoint, $form);

    if ($response->code != 200 && $this->options['raise_exceptions']) {
      throw new Exception($response->raw_body, $response->code);
    }

    return $response;
  }

  /**
   * Makes the actual HTTP request to SendGrid using Guzzle. The form is an
   * array of ready options for SendGrid email.
   *
   * @param string $endpoint
   * @param array $form
   *
   * @return bool|SendGrid\Response
   */
  public function postRequest($endpoint, $form) {
    $requestoptions = [];
    if (array_key_exists('files', $form)) {
      // If the email contains files we must process as multipart.
      $requestoptions['multipart'] = $this->prepareMultipart($form);
    }
    else {
      $requestoptions['form_params'] = $form;
    }

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
    catch (\GuzzleHttp\Exception\ClientException $e) {
      echo 'Sendgrid API has experienced and error completing your request.';
      echo '<pre>';
      var_dump($e);
      echo '</pre>';
      return FALSE;
    }
    $response = new Response($res->getStatusCode(), $res->getHeaders(), $res->getBody(TRUE), json_decode($res->getBody(TRUE)));

    return $response;
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
