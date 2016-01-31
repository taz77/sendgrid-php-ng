<?php

namespace SendGrid;

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
    $date,
    $content,
    $headers,
    $smtpapi,
    $attachments;

  public function __construct() {
    $this->fromName = FALSE;
    $this->replyTo = FALSE;
    $this->smtpapi = new \Smtpapi\Header();
  }

  /**
   * _removeFromList
   * Given a list of key/value pairs, removes the associated keys
   * where a value matches the given string ($item)
   *
   * @param array $list - the list of key/value pairs
   * @param string $item - the value to be removed
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
   * Add receipient email addresses. You may optionally provide the name of the
   * receipient as a string.
   *
   * @param string $email
   * @param string $name
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
   * Add receipient email addresses to the X-SMTPAPI headers. You may optionally
   * provide the name of thereceipient as a string.
   *
   * @param string $email
   * @param string $name
   * @return object $this
   */
  public function addSmtpapiTo($email, $name = NULL) {
    $this->smtpapi->addTo($email, $name);

    return $this;
  }

  /**
   * Add receipients as an array of addresses.
   *
   * @param array $emails
   * @return object $this
   */
  public function setTos(array $emails) {
    $this->to = $emails;

    return $this;
  }

  /**
   * Add receipient email addresses to the X-SMTPAPI headers as an array.
   *
   * @param array $emails
   * @return object $this
   */
  public function setSmtpapiTos(array $emails) {
    $this->smtpapi->setTos($emails);

    return $this;
  }

  /**
   * Add names of receipients.
   *
   * @param string $name
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
   * @return array $this->toName
   */
  public function getToNames() {
    return $this->toName;
  }

  /**
   * Sets the email address to use as the from address.
   * @param string $email
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
   * @return object $this
   */
  public function setReplyTo($email) {
    $this->replyTo = $email;

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
   * Set the CC address of the message.
   *
   * @param string $email
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
   * @param string $email
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
   * @return $this
   */
  public function setBccs(array $email_list) {
    $this->bcc = $email_list;

    return $this;
  }

  /**
   * Add a BCC address to the current message. Optionally set a name with the
   * address.
   * @param string $email
   * @param string $name
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
   * Set the date header of the current message. Must be RFC 2822 ( date("r"); ).
   *
   * @param string $date
   * @return object $this
   */
  public function setDate($date) {
    $this->date = $date;

    return $this;
  }

  /**
   * Returns the date header on the current messge. Returns RFC 2822 formated
   * date.
   *
   * @return string $this->date
   */
  public function getDate() {
    return $this->date;
  }

  /**
   * Set the plain text version of the current message.
   *
   * @param string $text
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
   * @param string $timestamp
   * @return object $this
   */
  public function setSendAt($timestamp) {
    $this->smtpapi->setSendAt($timestamp);

    return $this;
  }

  /**
   * You can schedule emails to send at certain times per receipient. Use this
   * by supplying an array of timestamps. Timestamps must be UNIX time.
   * Time stamps will be associated with the to addresses on a one to one basis.
   *
   * @see setTos() function for setting to addresses via an array.
   *
   * @param array $timestamps
   * @return object $this
   */
  public function setSendEachAt(array $timestamps) {
    $this->smtpapi->setSendEachAt($timestamps);

    return $this;
  }

  public function addSendEachAt($timestamp) {
    $this->smtpapi->addSendEachAt($timestamp);

    return $this;
  }

  /**
   * Add templates defined in Sendgrid to a message. Requies the ID number of
   * the template.
   *
   * @param string $templateId
   * @return object $this
   */
  public function setTemplateId($templateId) {
    $this->addFilter('templates', 'enabled', 1);
    $this->addFilter('templates', 'template_id', $templateId);

    return $this;
  }

  /**
   * Set the ASM group ID for the current message.
   *
   * @param string $groupId
   * @return object $this
   */
  public function setAsmGroupId($groupId) {
    $this->smtpapi->setASMGroupID($groupId);

    return $this;
  }

  /**
   * Add  multiple attachments to the current message. Supply an array of
   * absolute file paths.
   *
   * @param array $files
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
   * @return object $this
   */
  public function setAttachment($file, $custom_filename = NULL, $cid = NULL) {
    $this->attachments = [$this->getAttachmentInfo($file, $custom_filename, $cid)];

    return $this;
  }

  /**
   * Add additional attachments to the current message.
   *
   * @param string $file
   * @param string $custom_filename
   * @param string $cid
   * @return object $this
   */
  public function addAttachment($file, $custom_filename = NULL, $cid = NULL) {
    $this->attachments[] = $this->getAttachmentInfo($file, $custom_filename, $cid);

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
   * @return array $info
   */
  private function getAttachmentInfo($file, $custom_filename = NULL, $cid = NULL) {
    $info = pathinfo($file);
    $info['file'] = $file;
    if (!is_null($custom_filename)) {
      $info['custom_filename'] = $custom_filename;
    }
    if ($cid !== NULL) {
      $info['cid'] = $cid;
    }

    return $info;
  }

  /**
   * Set multiple catagories for the current message. Overwrites existing
   * catagories.
   *
   * @param array $categories
   * @return object $this
   */
  public function setCategories($categories) {
    $this->smtpapi->setCategories($categories);

    return $this;
  }

  /**
   * Set a catagory for the current message. Overwrites existing catagories.
   *
   * @param string $category
   * @return object $this
   */
  public function setCategory($category) {
    $this->smtpapi->setCategory($category);

    return $this;
  }

  /**
   * Add a category to the existing catagories.
   *
   * @param string $category
   * @return object $this
   */
  public function addCategory($category) {
    $this->smtpapi->addCategory($category);

    return $this;
  }

  /**
   * Remove a category from the message.
   *
   * @param string $category
   * @return object $this
   */
  public function removeCategory($category) {
    $this->smtpapi->removeCategory($category);

    return $this;
  }

  public function setSubstitutions($key_value_pairs) {
    $this->smtpapi->setSubstitutions($key_value_pairs);

    return $this;
  }

  public function addSubstitution($from_value, array $to_values) {
    $this->smtpapi->addSubstitution($from_value, $to_values);

    return $this;
  }

  public function setSections(array $key_value_pairs) {
    $this->smtpapi->setSections($key_value_pairs);

    return $this;
  }

  public function addSection($from_value, $to_value) {
    $this->smtpapi->addSection($from_value, $to_value);

    return $this;
  }

  public function setUniqueArgs(array $key_value_pairs) {
    $this->smtpapi->setUniqueArgs($key_value_pairs);

    return $this;
  }

  ## synonym method
  public function setUniqueArguments(array $key_value_pairs) {
    $this->smtpapi->setUniqueArgs($key_value_pairs);

    return $this;
  }

  public function addUniqueArg($key, $value) {
    $this->smtpapi->addUniqueArg($key, $value);

    return $this;
  }

  ## synonym method
  public function addUniqueArgument($key, $value) {
    $this->smtpapi->addUniqueArg($key, $value);

    return $this;
  }

  public function setFilters($filter_settings) {
    $this->smtpapi->setFilters($filter_settings);

    return $this;
  }

  ## synonym method
  public function setFilterSettings($filter_settings) {
    $this->smtpapi->setFilters($filter_settings);

    return $this;
  }

  public function addFilter($filter_name, $parameter_name, $parameter_value) {
    $this->smtpapi->addFilter($filter_name, $parameter_name, $parameter_value);

    return $this;
  }

  ## synonym method
  public function addFilterSetting($filter_name, $parameter_name, $parameter_value) {
    $this->smtpapi->addFilter($filter_name, $parameter_name, $parameter_value);

    return $this;
  }

  public function getHeaders() {
    return $this->headers;
  }

  public function getHeadersJson() {
    if (count($this->getHeaders()) <= 0) {
      return NULL;
    }

    return json_encode($this->getHeaders(), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP);
  }

  public function setHeaders($key_value_pairs) {
    $this->headers = $key_value_pairs;

    return $this;
  }

  public function addHeader($key, $value) {
    $this->headers[$key] = $value;

    return $this;
  }

  public function removeHeader($key) {
    unset($this->headers[$key]);

    return $this;
  }

  /**
   * Return the entire Smtpapi header.
   *
   * @return \Smtpapi\Header
   */
  public function getSmtpapi() {
    return $this->smtpapi;
  }

  /**
   * Prepares the email message by assembling the information from the Sendgrid
   * object into a format that can be used for transport by Guzzle. This is the
   * last step before sending an email
   *
   * @return array $web
   */
  public function toWebFormat() {
    $web = [
      'to' => $this->to,
      'from' => $this->getFrom(),
      'subject' => $this->getSubject(),
      'text' => $this->getText(),
      'html' => $this->getHtml(),
    ];
    if (!empty($this->smtpapi->jsonString()) || $this->smtpapi->jsonString() != '{}') {
      $web['x-smtpapi'] = $this->smtpapi->jsonString();
    }
    if (!empty($this->getHeadersJson()) || $this->getHeadersJson() != '{}') {
      $web['headers'] = $this->getHeadersJson();
    }
    if ($this->getToNames()) {
      $web['toname'] = $this->getToNames();
    }
    if ($this->getCcs()) {
      $web['cc'] = $this->getCcs();
    }
    if ($this->getCcNames()) {
      $web['ccname'] = $this->getCcNames();
    }
    if ($this->getBccs()) {
      $web['bcc'] = $this->getBccs();
    }
    if ($this->getBccNames()) {
      $web['bccname'] = $this->getBccNames();
    }
    if ($this->getFromName()) {
      $web['fromname'] = $this->getFromName();
    }
    if ($this->getReplyTo()) {
      $web['replyto'] = $this->getReplyTo();
    }
    if ($this->getDate()) {
      $web['date'] = $this->getDate();
    }
    if ($this->smtpapi->to && (count($this->smtpapi->to) > 0)) {
      $web['to'] = "";
    }

    $web = $this->updateMissingTo($web);

    if ($this->getAttachments()) {
      foreach ($this->getAttachments() as $f) {
        $file = $f['file'];
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
      };
    }

    return $web;
  }

  /**
   * There needs to be at least one to address, or else the mail won't send.
   * This method modifies the data that will be sent via either Rest
   *
   * @param mixed $data
   * @return mixed $data
   */
  public function updateMissingTo($data) {
    if ($this->smtpapi->to && (count($this->smtpapi->to) > 0)) {
      $data['to'] = $this->getFrom();
    }

    return $data;
  }
}
