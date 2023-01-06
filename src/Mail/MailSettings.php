<?php
/**
 * This helper builds the MailSettings object for a /mail/send API call
 */

namespace SendGrid\Mail;

use JsonSerializable;
use SendGrid\Exception\SendgridException;
use SendGrid\Helper\Assert;

/**
 * This class is used to construct a MailSettings object for the /mail/send API
 * call
 *
 * A collection of different mail settings that you can use to specify how you
 * would like this email to be handled
 *
 * @package SendGrid\Mail
 */
class MailSettings implements JsonSerializable {

  /** @var $bcc Bcc object */
  private $bcc;

  /** @var $bypass_list_management BypassListManagement object */
  private $bypass_list_management;

  /** @var $footer Footer object */
  private $footer;

  /** @var $sandbox_mode SandBoxMode object */
  private $sandbox_mode;

  /** @var $spam_check SpamCheck object */
  private $spam_check;

  /**
   * Optional constructor
   *
   * @param BccSettings|null $bcc_settings BccSettings object
   * @param BypassListManagement|null $bypass_list_management BypassListManagement
   *   object
   * @param Footer|null $footer Footer object
   * @param SandBoxMode|null $sandbox_mode SandBoxMode object
   * @param SpamCheck|null $spam_check SpamCheck object
   *
   * @throws SendgridException
   */
  public function __construct(
    $bcc_settings = NULL,
    $bypass_list_management = NULL,
    $footer = NULL,
    $sandbox_mode = NULL,
    $spam_check = NULL
  ) {
    if (isset($bcc_settings)) {
      $this->setBccSettings($bcc_settings);
    }
    if (isset($bypass_list_management)) {
      $this->setBypassListManagement($bypass_list_management);
    }
    if (isset($footer)) {
      $this->setFooter($footer);
    }
    if (isset($sandbox_mode)) {
      $this->setSandboxMode($sandbox_mode);
    }
    if (isset($spam_check)) {
      $this->setSpamCheck($spam_check);
    }
  }

  /**
   * Set the bcc settings on a MailSettings object
   *
   * @param BccSettings|bool $enable The BccSettings object or an indication
   *                                 if the setting is enabled
   * @param string|null $email The email address that you would like
   *                                 to receive the BCC
   *
   * @throws SendgridException
   */
  public function setBccSettings($enable, $email = NULL) {
    if ($enable instanceof BccSettings) {
      $bcc = $enable;
      $this->bcc = $bcc;
      return;
    }
    Assert::boolean(
      $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BccSettings or a boolean.'
    );
    $this->bcc = new BccSettings($enable, $email);
  }

  /**
   * Retrieve the bcc settings from a MailSettings object
   *
   * @return Bcc
   */
  public function getBccSettings() {
    return $this->bcc;
  }

  /**
   * Set bypass list management settings on a MailSettings object
   *
   * @param BypassListManagement|bool $enable The BypassListManagement
   *                                          object or an indication
   *                                          if the setting is enabled
   *
   * @throws SendgridException
   */
  public function setBypassListManagement($enable) {
    if ($enable instanceof BypassListManagement) {
      $bypass_list_management = $enable;
      $this->bypass_list_management = $bypass_list_management;
      return;
    }
    Assert::boolean(
      $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\BypassListManagement or a boolean.'
    );
    $this->bypass_list_management = new BypassListManagement($enable);
  }

  /**
   * Retrieve bypass list management settings from a MailSettings object
   *
   * @return BypassListManagement
   */
  public function getBypassListManagement() {
    return $this->bypass_list_management;
  }

  /**
   * Set the footer settings on a MailSettings object
   *
   * @param Footer|bool $enable The Footer object or an indication
   *                            if the setting is enabled
   * @param string|null $text The plain text content of your footer
   * @param string|null $html The HTML content of your footer
   *
   * @throws SendgridException
   */
  public function setFooter($enable, $text = NULL, $html = NULL) {
    if ($enable instanceof Footer) {
      $footer = $enable;
      $this->footer = $footer;
      return;
    }
    $this->footer = new Footer($enable, $text, $html);
  }

  /**
   * Retrieve the footer settings from a MailSettings object
   *
   * @return Footer
   */
  public function getFooter() {
    return $this->footer;
  }

  /**
   * Set sandbox mode settings on a MailSettings object
   *
   * @param SandBoxMode|bool $enable The SandBoxMode object or an
   *                                 indication if the setting is enabled
   *
   * @throws SendgridException
   */
  public function setSandboxMode($enable) {
    if ($enable instanceof SandBoxMode) {
      $sandbox_mode = $enable;
      $this->sandbox_mode = $sandbox_mode;
      return;
    }
    Assert::boolean(
      $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\SandBoxMode or a boolean.'
    );
    $this->sandbox_mode = new SandBoxMode($enable);
  }

  /**
   * Retrieve sandbox mode settings on a MailSettings object
   *
   * @return SandBoxMode
   */
  public function getSandboxMode() {
    return $this->sandbox_mode;
  }

  /**
   * Enable sandbox mode on a MailSettings object
   *
   * @throws SendgridException
   */
  public function enableSandboxMode() {
    $this->setSandboxMode(TRUE);
  }

  /**
   * Disable sandbox mode on a MailSettings object
   *
   * @throws SendgridException
   */
  public function disableSandboxMode() {
    $this->setSandboxMode(FALSE);
  }

  /**
   * Set spam check settings on a MailSettings object
   *
   * @param SpamCheck|bool $enable The SpamCheck object or an
   *                                    indication if the setting is enabled
   * @param int $threshold The threshold used to determine if your
   *                                    content qualifies as spam on a scale
   *                                    from 1 to 10, with 10 being most strict,
   *                                    or most
   * @param string $post_to_url An Inbound Parse URL that you would like
   *                                    a copy of your email along with the spam
   *                                    report to be sent to
   *
   * @throws SendgridException
   */
  public function setSpamCheck($enable, $threshold = NULL, $post_to_url = NULL) {
    if ($enable instanceof SpamCheck) {
      $spam_check = $enable;
      $this->spam_check = $spam_check;
      return;
    }
    Assert::boolean(
      $enable, 'enable', 'Value "$enable" must be an instance of SendGrid\Mail\SpamCheck or a boolean.'
    );
    $this->spam_check = new SpamCheck($enable, $threshold, $post_to_url);
  }

  /**
   * Retrieve spam check settings from a MailSettings object
   *
   * @return SpamCheck
   */
  public function getSpamCheck() {
    return $this->spam_check;
  }

  /**
   * Return an array representing a MailSettings object for the Twilio SendGrid
   * API
   *
   * @return null|array
   */
  public function jsonSerialize() :mixed {
    return array_filter(
      [
        'bcc' => $this->getBccSettings(),
        'bypass_list_management' => $this->getBypassListManagement(),
        'footer' => $this->getFooter(),
        'sandbox_mode' => $this->getSandboxMode(),
        'spam_check' => $this->getSpamCheck(),
      ],
      function ($value) {
        return $value !== NULL;
      }
    ) ?: NULL;
  }
}
