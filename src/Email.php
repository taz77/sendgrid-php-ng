<?php

namespace Fastglass\SendGrid;

/**
 * Class Email
 *
 * @package SendGrid
 */

class Email {

  public
    $to,
    $toName,
    $from,
    $fromName,
    $replyTo,
    $cc,
    $ccName,
    $bcc,
    $bccName,
    $subject,
    $text,
    $html,
    $content,
    $headers,
    $attachments,
    $sendat,
    $asm,
    $categories,
    $substitutions,
    $sendeachat,
    $sections;

  /**
   * Email constructor.
   */
  public function __construct() {
    $this->fromName = FALSE;
    $this->replyTo = FALSE;
  }

  /**
   * Given a list of key/value pairs (passed as a reference, removes the
   * associated keys where a value matches the given string ($item)
   *
   * @param array $list - the list of key/value pairs
   * @param string $item - the value to be removed
   * @param string $key_field
   */
  private function _removeFromList(&$list, $item, $key_field = NULL) {
    foreach ($list as $key => $val) {
      if ($key_field) {
        if ($val[$key_field] == $item) {
          unset($list[$key]);
        }
      }
      else {
        if ($val == $item) {
          unset($list[$key]);
        }
      }
    }
    //repack the indices
    $list = array_values($list);
  }

  /**
   * Add recipient email addresses. You may optionally provide the name of the
   * recipient as a string.
   *
   * @param string $email
   * @param string $name
   *
   * @return object $this
   */
  public function addTo($email, $name = NULL) {
    if ($this->to == NULL) {
      $this->to = [];
    }

    if (is_array($email)) {
      foreach ($email as $e) {
        $this->to[] = $e;
      }
    }
    else {
      $this->to[] = $email;
    }

    if (is_array($name)) {
      foreach ($name as $n) {
        $this->addToName($n);
      }
    }
    elseif ($name) {
      $this->addToName($name);
    }

    return $this;
  }

  /**
   * Add recipient email addresses to the X-SMTPAPI headers. You may optionally
   * provide the name of the recipient as a string.
   *
   * @param string $email
   * @param string $name
   *
   * @deprecated Use addTo().
   *
   * @return object $this
   */
  public function addSmtpapiTo($email, $name = NULL) {
    $this->addTo($email, $name);
    return $this;
  }

  /**
   * Add recipients as an array of addresses.
   *
   * @param array $emails
   *
   * @return object $this
   */
  public function setTos(array $emails) {
    $this->to = $emails;

    return $this;
  }

  /**
   * Add recipient email addresses to the X-SMTPAPI headers as an array.
   *
   * @deprecated Please use addTo().
   *
   * @param array $emails
   *
   * @return object $this
   */
  public function setSmtpapiTos(array $emails) {
    foreach ($emails as $key => $value) {
      $this->addTo($value, $key);
    }

    return $this;
  }

  /**
   * Add names of recipients.
   *
   * @param string $name
   *
   * @return object $this
   */
  public function addToName($name) {
    if ($this->toName == NULL) {
      $this->toName = [];
    }

    $this->toName[] = $name;

    return $this;
  }

  /**
   * Returns an array of names associate with TO addresses.
   *
   * @return array $this->toName
   */
  public function getToNames() {
    return $this->toName;
  }

  /**
   * Sets the email address to use as the from address.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function setFrom($email) {
    $this->from = $email;

    return $this;
  }

  /**
   * Returns an array of TO addresses.
   *
   * @return array $this->to
   */
  public function getTos() {
    return $this->to;
  }

  /**
   * Returns the from address information. If names are provided they are
   * returned as an array of names and addresses, otherwise a string is
   * returned containining only the email address.
   *
   * @param bool $as_array
   *
   * @return mixed $this->from
   */
  public function getFrom($as_array = FALSE) {
    if ($as_array && ($name = $this->getFromName())) {
      return ["$this->from" => $name];
    }
    else {
      return $this->from;
    }
  }

  /**
   * Sets the From name to be used.
   *
   * @param string $name
   *
   * @return object $this
   */
  public function setFromName($name) {
    $this->fromName = $name;

    return $this;
  }

  /**
   * Retruns the from name.
   *
   * @return string
   */
  public function getFromName() {
    return $this->fromName;
  }

  /**
   * Set the reply to address.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function setReplyTo($email) {
    $this->replyTo = $email;

    return $this;
  }

  /**
   * Set the reply to name.
   *
   * @param string $name
   *
   * @return object $this
   */
  public function setReplyToName($name) {
    $this->replyToName = $name;

    return $this;
  }

  /**
   * Return the reply to address as a string.
   *
   * @return string $this->replyTo
   */
  public function getReplyTo() {
    return $this->replyTo;
  }

  /**
   * Return the reply to name for the address as a string.
   *
   * @return string
   */
  public function getReplyToName() {
    return $this->replyToName;
  }

  /**
   * Set the CC address of the message.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function setCc($email) {
    $this->cc = [$email];

    return $this;
  }

  /**
   * Set the CC address(s) of the message as an array.
   *
   * @param array $email_list
   *
   * @return object $this
   */
  public function setCcs(array $email_list) {
    $this->cc = $email_list;

    return $this;
  }

  /**
   * Add a CC address to the message. Optionally provide the name as a string.
   *
   * @param string $email
   * @param string $name
   *
   * @return object $this
   */
  public function addCc($email, $name = NULL) {
    if ($this->cc == NULL) {
      $this->cc = [];
    }

    if (is_array($email)) {
      foreach ($email as $e) {
        $this->cc[] = $e;
      }
    }
    else {
      $this->cc[] = $email;
    }

    if (is_array($name)) {
      foreach ($name as $n) {
        $this->addCcName($n);
      }
    }
    elseif ($name) {
      $this->addCcName($name);
    }

    return $this;
  }

  /**
   * Add a CC name to the message.
   *
   * @param string $name
   *
   * @return object $this
   */
  public function addCcName($name) {
    if ($this->ccName == NULL) {
      $this->ccName = [];
    }

    $this->ccName[] = $name;

    return $this;
  }

  /**
   * Remove a CC email address from the message.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function removeCc($email) {
    $this->_removeFromList($this->cc, $email);

    return $this;
  }

  /**
   * Return an array of CC email addresses for the current message.
   *
   * @return array $this->cc
   */
  public function getCcs() {
    return $this->cc;
  }

  /**
   * Return an array of CC email names for the current message.
   *
   * @return array $this->ccName
   */
  public function getCcNames() {
    return $this->ccName;
  }

  /**
   * Set the BCC email address for the current messsage.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function setBcc($email) {
    $this->bcc = [$email];

    return $this;
  }

  /**
   * Set the BCC addresses of the current message by passing an array of only
   * email addresses.
   *
   * @param array $email_list
   *
   * @return $this
   */
  public function setBccs(array $email_list) {
    $this->bcc = $email_list;

    return $this;
  }

  /**
   * Add a BCC address to the current message. Optionally set a name with the
   * address.
   *
   * @param string $email
   * @param string $name
   *
   * @return object $this
   */
  public function addBcc($email, $name = NULL) {
    if ($this->bcc == NULL) {
      $this->bcc = [];
    }

    if (is_array($email)) {
      foreach ($email as $e) {
        $this->bcc[] = $e;
      }
    }
    else {
      $this->bcc[] = $email;
    }

    if (is_array($name)) {
      foreach ($name as $n) {
        $this->addBccName($n);
      }
    }
    elseif ($name) {
      $this->addBccName($name);
    }

    return $this;
  }

  /**
   * Add a BCC name to the current message.
   *
   * @param string $name
   *
   * @return object $this
   */
  public function addBccName($name) {
    if ($this->bccName == NULL) {
      $this->bccName = [];
    }

    $this->bccName[] = $name;

    return $this;
  }

  /**
   * Returns an array of BCC names.
   *
   * @return array $this->bccName
   */
  public function getBccNames() {
    return $this->bccName;
  }

  /**
   * Remove a BCC address from the current message.
   *
   * @param string $email
   *
   * @return object $this
   */
  public function removeBcc($email) {
    $this->_removeFromList($this->bcc, $email);

    return $this;
  }

  /**
   * Return the BCC addresses.
   *
   * @return array $this->bcc
   */
  public function getBccs() {
    return $this->bcc;
  }

  /**
   * Set the subject of the current message.
   *
   * @param string $subject
   *
   * @return object $this
   */
  public function setSubject($subject) {
    $this->subject = $subject;

    return $this;
  }

  /**
   * Return a string of the subject line of the current message.
   *
   * @return string $this->subject
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Set the plain text version of the current message.
   *
   * @param string $text
   *
   * @return object $this
   */
  public function setText($text) {
    $this->text = $text;

    return $this;
  }

  /**
   * Return the plain text version of the current message.
   *
   * @return string $this->text
   */
  public function getText() {
    return $this->text;
  }

  /**
   * Set the HTML version of the current message.
   *
   * @param string $html
   *
   * @return object $this
   */
  public function setHtml($html) {
    $this->html = $html;

    return $this;
  }

  /**
   * Return the HTML version of the current message.
   *
   * @return string $this->html
   */
  public function getHtml() {
    return $this->html;
  }

  /**
   * Set the X-SMTPAPI header of the send at date that allows you to use the
   * scheduling function of Sendgrid. Requires UNIX timestamp.
   *
   * @param integer $timestamp
   *
   * @return object $this
   *
   * @throws \Exception
   */
  public function setSendAt($timestamp) {
    if ($this->isValidTimeStamp($timestamp)) {
      $this->sendat = $timestamp;
      return $this;
    }
    throw new \Exception('Invalid timestamp. Must be a unix timestamp.');
  }

  /**
   * Return the send at time.
   *
   * @return mixed
   */
  public function getSendAt() {
    return $this->sendat;
  }

  /**
   * You can schedule emails to send at certain times per recipient. Use this
   * by supplying an array of timestamps. Timestamps must be UNIX time.
   * Time stamps will be associated with the to addresses on a one to one basis.
   *
   * @see setTos() function for setting to addresses via an array.
   *
   * @param array $timestamps
   *
   * @return object $this
   */
  public function setSendEachAt(array $timestamps) {
    $this->sendeachat = $timestamps;

    return $this;
  }

  /**
   * Add a time-to-send-at to the array of times. If the array has not been set
   * it will created.
   *
   * @param int $timestamp
   *
   * @return $this
   */
  public function addSendEachAt($timestamp) {
    if (empty($this->sendeachat)) {
      $this->substitutions = $timestamp;
    }
    else {
      $this->sendeachat = array_merge($this->sendeachat, $timestamp);
    }

    return $this;
  }

  /**
   * Add templates defined in Sendgrid to a message. Requies the ID number of
   * the template.
   *
   * @param string $templateId
   *
   * @return object $this
   */
  public function setTemplateId($templateId) {
    $this->addFilter('templates', 'enable', 1);
    $this->addFilter('templates', 'template_id', $templateId);

    return $this;
  }

  /**
   * Set the ASM group ID for the current message.
   *
   * @param int $groupId
   *
   * @return object $this
   */
  public function setAsmGroupId($groupId) {
    $this->asm = new \stdClass();
    $this->asm->group_id = $groupId;

    return $this;
  }

  /**
   * Set the ASM groups to display on the unsubscribe page.
   *
   * @param array $groupId
   *
   * @return object $this
   *
   * @throws \Exception
   *   A group ID is required for ASM.
   */
  public function setAsmGroupToDisplay(array $groupsToDisplay) {
    if (!is_object($this->asm) && !empty($this->asm->group_id)) {
      $this->asm->groups_to_display = $groupsToDisplay;
    }
    else {
      throw new \Exception('An ASM Group ID must be set before setting ASM groups to display.');
    }
    return $this;
  }

  /**
   * Add  multiple attachments to the current message. Supply an array of
   * absolute file paths.
   *
   * @param array $files
   *
   * @return object $this
   */
  public function setAttachments(array $files) {
    $this->attachments = [];

    foreach ($files as $filename => $file) {
      if (is_string($filename)) {
        $this->addAttachment($file, $filename);
      }
      else {
        $this->addAttachment($file);
      }
    }

    return $this;
  }

  /**
   * Set an attachment to the current message. Supply a string of an absolute
   * file path. May provide a custom filename as a string and an ID number.
   *
   * @param string $file
   * @param string $custom_filename
   * @param string $cid
   *
   * @return object $this
   */
  public function setAttachment($file, $custom_filename = NULL, $cid = NULL, $mimetype = NULL, $disposition = 'attachment') {
    $this->attachments = [$this->getAttachmentInfo($file, $custom_filename, $cid, $mimetype, $disposition)];

    return $this;
  }

  /**
   * Add additional attachments to the current message.
   *
   * @param string $file
   * @param string $custom_filename
   * @param string $cid
   * @param string $mimetype
   *
   * @return object $this
   */
  public function addAttachment($file, $custom_filename = NULL, $cid = NULL, $mimetype = NULL, $disposition = 'attachment') {
    $this->attachments[] = $this->getAttachmentInfo($file, $custom_filename, $cid, $mimetype, $disposition);

    return $this;
  }

  /**
   * Retun an array of the attachments on the current message.
   *
   * @return array $this->attachments
   */
  public function getAttachments() {
    return $this->attachments;
  }

  /**
   * Remove an attachment from the current message.
   *
   * @param string $file
   *
   * @return object $this
   */
  public function removeAttachment($file) {
    $this->_removeFromList($this->attachments, $file, "file");

    return $this;
  }

  /**
   * Returns the pathinfo() data about a file. Pass this function the full path
   * to the file in question.
   *
   * @param string $file
   * @param string $custom_filename
   * @param string $cid
   * @param string $mimetype
   *
   * @return array $info
   */
  private function getAttachmentInfo($file, $custom_filename, $cid, $mimetype, $disposition) {
    $info = pathinfo($file);
    $info['file'] = $file;
    if (!is_null($custom_filename)) {
      $info['custom_filename'] = $custom_filename;
    }
    if ($cid !== NULL) {
      $info['cid'] = $cid;
    }
    if ($mimetype !== NULL) {
      $info['mimetype'] = $mimetype;
    }
    $info['disposition'] = $disposition;
    return $info;
  }

  /**
   * Set multiple catagories for the current message. Overwrites existing
   * catagories.
   *
   * @param array $categories
   *
   * @return object $this
   */
  public function setCategories($categories) {
    $this->categories = $categories;

    return $this;
  }

  /**
   * Set a catagory for the current message. Overwrites existing catagories.
   *
   * @param string $category
   *
   * @return object $this
   */
  public function setCategory($category) {
    if (!empty($this->categories)) {
      unset($this->categories);
    }
    $this->categories = [$category];
    return $this;
  }

  /**
   * Add a category to the existing catagories.
   *
   * @param string $category
   *
   * @return object $this
   */
  public function addCategory($category) {
    $this->categories[] = $category;
    return $this;
  }

  /**
   * Remove a category from the message.
   *
   * @param string $category
   *
   * @return object $this
   */
  public function removeCategory($category) {
    unset($this->categories[$category]);

    return $this;
  }

  /**
   * Set multimple substitutions for the current message. The key of the array
   * is the needle in the haystack of the substitution (search phrase). This
   * overrides any existing substitutions. These values are specific to a
   * user. Can be used for demographics substitutions such as "First Name"
   *
   * @param array $key_value_pairs
   *
   * @return object $this
   */
  public function setSubstitutions(array $key_value_pairs) {
    $this->substitutions = $key_value_pairs;

    return $this;
  }

  /**
   * Add a substitution to the existng message. Supply the values in a
   * key-value pair as an array. These are values specific to users such as
   * demographics (First Name, Contact phone, etc.).
   *
   * @param array $key_value_pairs
   *
   * @return object $this
   */
  public function addSubstitution(array $key_value_pairs) {
    if (empty($this->substitutions)) {
      $this->substitutions = $key_value_pairs;
    }
    else {
      $this->substitutions = array_merge($this->substitutions, $key_value_pairs);
    }

    return $this;
  }

  /**
   * Set the sections substitutions for the current message. This overrides any
   * exisitng settings for sections. Sections are substitutions of text in the
   * message that are not user specific.
   *
   * @param array $key_value_pairs
   *
   * @return $this
   */
  public function setSections(array $key_value_pairs) {
    $this->sections = new \stdClass();
    foreach ($key_value_pairs as $key => $value) {
      $this->sections->$key = $value;
    }
    return $this;
  }

  /**
   * Add a section to the current message. This does not override existing
   * settings for sections. Sections are text replacements within the message
   * that are not specific to the user.
   *
   * @param array $key_value_pairs
   *
   * @return object $this
   */
  public function addSection(array $key_value_pairs) {
    if (empty($this->sections)) {
      $this->sections = new \stdClass();
      foreach ($key_value_pairs as $key => $value) {
        $this->sections->$key = $value;
      }
    }
    else {
      foreach ($key_value_pairs as $key => $value) {
        $this->sections->$key = $value;
      }
    }
    return $this;
  }

  /**
   *
   * @deprecated Not supported in V3 API
   *
   * @param array $key_value_pairs
   *
   * @return object $this
   */
  public function setUniqueArgs(array $key_value_pairs) {

    return $this;
  }

  /**
   *
   * @deprecated Not supported in V3 API
   *
   * @param array $key_value_pairs
   *
   * @return $this
   */
  public function setUniqueArguments(array $key_value_pairs) {

    return $this;
  }

  /**
   * @deprecated Not supported in V3 API
   *
   * @param string $key
   * @param string $value
   *
   * @return object $this
   */
  public function addUniqueArg($key, $value) {

    return $this;
  }

  /**
   * @deprecated Not supported in V3 API
   *
   * @see function addUniqueArg()
   *
   * @param string $key
   * @param string $value
   *
   * @return object $this
   */
  public function addUniqueArgument($key, $value) {

    return $this;
  }

  /**
   * Turn on multiple filters (Apps) for a message. Takes an array of apps and
   * their settings refer to the documentation below for the array
   * structure and options offered. This overrides any Filters set.
   *
   * @param array $filter_settings
   *
   * @return object $this
   */
  public function setFilters(array $filter_settings) {
    $this->smtpapi->setFilters($filter_settings);

    return $this;
  }

  /**
   * Synonym function to set filters/apps.
   *
   * @see function setFilters()
   *
   * @param array $filter_settings
   *
   * @return object $this
   */
  public function setFilterSettings(array $filter_settings) {
    $this->smtpapi->setFilters($filter_settings);

    return $this;
  }

  /**
   * This is used to add a filter (App) to a message. Must provide the App name
   * paramater name and paramater value.
   *
   * @param string $filter_name
   * @param string $parameter_name
   * @param string $parameter_value
   *
   * @return object $this
   */
  public function addFilter($filter_name, $parameter_name, $parameter_value) {
    $this->smtpapi->addFilter($filter_name, $parameter_name, $parameter_value);

    return $this;
  }

  /**
   * Synonym function for adding Apps to a message.
   *
   * @see function addFilter().
   *
   * @param string $filter_name
   * @param string $parameter_name
   * @param string $parameter_value
   *
   * @return object $this
   */
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value) {
    $this->smtpapi->addFilter($filter_name, $parameter_name, $parameter_value);

    return $this;
  }

  /**
   * Return the headers for the current message. Returns an array of keys
   * (names) and values for all of the message headers.
   *
   * @return array $this->headers
   */
  public function getHeaders() {
    return $this->headers;
  }

  /**
   * If headers are set it returns them as JSON.
   *
   * @return null|string
   */
  public function getHeadersJson() {
    if (count($this->getHeaders()) <= 0) {
      return NULL;
    }

    return json_encode($this->getHeaders(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
  }

  /**
   * Set headers by passing an array of key/value custom header values.
   *
   * @param array $key_value_pairs
   *
   * @return $this
   *
   * @see https://sendgrid.com/docs/API_Reference/api_v3.html
   */
  public function setHeaders($key_value_pairs) {
    $this->headers = $key_value_pairs;

    return $this;
  }

  /**
   * Add a header item to the current message.
   *
   * @param string $key
   * @param string $value
   *
   * @return object $this
   */
  public function addHeader($key, $value) {
    $this->headers[$key] = $value;

    return $this;
  }

  /**
   * Remove a header item from the current message.
   *
   * @param string $key
   *
   * @return object $this
   */
  public function removeHeader($key) {
    unset($this->headers[$key]);

    return $this;
  }

  /**
   * Return the entire Smtpapi header object.
   *
   */
  public function getSmtpapi() {
    return $this->smtpapi;
  }

  /**
   * Prepares the email message by assembling the information from the Sendgrid
   * object into a format that can be used for transport by Guzzle. This is the
   * last step before sending an email
   *
   * @todo the conversion to v3 api will take place here.
   *
   * @return $message
   *
   * @throws Exception
   *
   */
  public function toWebFormat() {

    // Email content. An array of objects in the V3 API.
    if ($this->getText()) {
      $contentemail = new Content('text/plain', $this->getText());
      $web['contents'][] = $contentemail;
    }
    if ($this->getHtml()) {
      $contentemail = new Content('text/html', $this->getHtml());
      $web['contents'][] = $contentemail;
    }

    // Content cannot be empty. Throw an exception.
    if (empty($web['contents'])) {
      throw new Exception('Your email has no content. This cannot be sent to SendGrid.');
    }

    // To addressing section of email.
    $toaddress = [];
    if (empty($this->to)) {
      throw new Exception('There must be a to email address.');
    }
    // @todo Accomodate multiple addresses.
    if (empty($this->to) && !empty($this->smtpapi->to)) {
      $toaddress['email'] = $this->smtpapi->to;
    }
    else {
      $toaddress['email'] = $this->to;
    }
    $toaddress['name'] = !empty($this->getToNames()) ? $this->getToNames() : '';
    $to = new EmailAddress($toaddress['name'], $toaddress['email']);

    // From addressing.
    $fromname = !empty($this->getFromName()) ? $this->getFromName() : '';
    $from = new EmailAddress($fromname, $this->getFrom());

    // Subject.
    $subject = $this->getSubject();

    // Begin the message object.
    $message = new Message($from, $subject, $to, $web['contents']);

    // Send at time set for both the message and the personalizations.
    // @TODO make the personalizations have a separate sendat.
    if (!empty($this->sendat)) {
      $message->setSendAt($this->sendat);
    }

    // Process replyto if it exists.
    if ($this->getReplyTo()) {
      $replytoname = !empty($this->getReplyToName()) ? $this->getReplyToName() : '';
      $replyto = new EmailAddress($replytoname, $this->getReplyTo());
      $message->setReplyTo($replyto);
    }

    // Begin the array of objects for personalizations. V3 Upgrade.
    $personalization = new Personalization();

    // Carbon copy addresses.
    if ($this->getCcs()) {
      $ccaddress = [];
      $ccaddress['email'] = $this->getCcs();
    }
    if ($this->getCcNames()) {
      $ccaddress['name'] = $this->getCcNames();
    }
    else {
      $ccaddress['name'] = '';
    }
    if (!empty($ccaddress['email'])) {
      $ccemail = new EmailAddress($ccaddress['name'], $ccaddress['email']);
      $personalization->addCC($ccemail);
    }

    // Blind copy addresses.
    if ($this->getBccs()) {
      $bccaddress = [];
      $bccaddress['email'] = $this->getBccs();
      $bccaddress['name'] = empty($this->getBccNames()) ? '' : $this->getBccNames();
    }

    if (!empty($bccaddress)) {
      $bccemail = new EmailAddress($bccaddress['name'], $bccaddress['email']);
      $personalization->addBcc($bccemail);
    }

    // Add personalization.
    $message->addPersonalization($personalization);

    // Process email message headers.
    if (!empty($this->getHeaders())) {
      foreach ($this->getHeaders() as $item => $value) {
        $message->addHeader($item, $value);
      }
    }

    if ($this->getAttachments()) {
      foreach ($this->getAttachments() as $f) {

        $extension = NULL;
        if (array_key_exists('extension', $f)) {
          $extension = $f['extension'];
        };
        $filename = $f['filename'];
        $full_filename = $filename;

        if (isset($extension)) {
          $full_filename = $filename . '.' . $extension;
        }
        if (array_key_exists('custom_filename', $f)) {
          $full_filename = $f['custom_filename'];
        }

        if (array_key_exists('cid', $f)) {
          $web['content[' . $full_filename . ']'] = $f['cid'];
        }
        // This creates an keyed array with the filenames as the key and the
        // full path as a value.
        $web['files'][$f['basename']] = $f['dirname'] . '/' . $f['basename'];
        $filesstring = file_get_contents($f['dirname'] . '/' . $f['basename']);
        $filecontent = base64_encode($filesstring);
        $attachment = new Attachment();
        $attachment->setContent($filecontent);
        if (!empty($f['mimetype'])) {
          $attachment->setType($f['mimetype']);
        }
        $attachment->setFilename($f['basename']);
        $attachment->setDisposition('attachment');
        $messageUuid = uniqid('', FALSE);
        $attachment->setContentId($messageUuid);
        $message->addAttachment($attachment);
      };
    }
    return $message;
  }

  /**
   * Checks for a valid Unix time stamp.
   *
   * @param int $timestamp
   *
   * @return bool
   */
  private function isValidTimeStamp($timestamp) {
    return ((string) (int) $timestamp === $timestamp)
      && ($timestamp <= PHP_INT_MAX)
      && ($timestamp >= ~PHP_INT_MAX);
  }
}

