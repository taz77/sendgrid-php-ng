<?php
/**
 * Create the personalization array for V3 API of SendGrid.
 *
 * @author Brady Owens
 * @package SendGrid
 *
 */

namespace SendGrid\Mail;


class Personalization implements \JsonSerializable {

  private
    $tos,
    $ccs,
    $bccs,
    $subject,
    $headers,
    $substitutions,
    $custom_args,
    $send_at;

  /**
   * Add email addresses to the message.
   *
   * @param object $email
   */
  public function addTo($email) {
    $this->tos[] = $email;
  }

  /**
   * Get to addresses.
   *
   * @return array
   */
  public function getTos() {
    return $this->tos;
  }

  /**
   * Add cc address.
   *
   * @param object $email
   */
  public function addCc($email) {
    $this->ccs[] = $email;
  }

  /**
   * Get cc addresses.
   *
   * @return array
   */
  public function getCcs() {
    return $this->ccs;
  }

  /**
   * Add a bcc address.
   *
   * @param object $email
   */
  public function addBcc($email) {
    $this->bccs[] = $email;
  }

  /**
   * Get bcc addresses.
   *
   * @return array
   */
  public function getBccs() {
    return $this->bccs;
  }

  /**
   * Set the subject.
   *
   * @param string $subject
   */
  public function setSubject($subject) {
    $this->subject = $subject;
  }

  /**
   * Return the subject.
   *
   * @return string
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Add a header to the email.
   *
   * @param string $key
   * @param string $value
   */
  public function addHeader($key, $value) {
    $this->headers[$key] = $value;
  }

  /**
   * Return headers set.
   *
   * @return array
   */
  public function getHeaders() {
    return $this->headers;
  }

  /**
   * @param $key
   * @param $value
   */
  public function addSubstitution($key, $value) {
    $this->substitutions[$key] = $value;
  }

  /**
   * @return mixed
   */
  public function getSubstitutions() {
    return $this->substitutions;
  }

  /**
   * @param $key
   * @param $value
   */
  public function addCustomArg($key, $value) {
    $this->custom_args[$key] = $value;
  }

  /**
   * @return mixed
   */
  public function getCustomArgs() {
    return $this->custom_args;
  }

  /**
   * @param $send_at
   */
  public function setSendAt($send_at) {
    $this->send_at = $send_at;
  }

  /**
   * @return mixed
   */
  public function getSendAt() {
    return $this->send_at;
  }

  /**
   * @return array|ø
   */
  public function jsonSerialize() {
    return array_filter(
      [
        'to' => $this->getTos(),
        'cc' => $this->getCcs(),
        'bcc' => $this->getBccs(),
        'subject' => $this->subject,
        'headers' => $this->getHeaders(),
        'substitutions' => $this->getSubstitutions(),
        'custom_args' => $this->getCustomArgs(),
        'send_at' => $this->getSendAt(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}
