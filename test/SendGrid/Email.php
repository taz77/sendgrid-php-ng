<?php

use SendGrid;

class SendGridTest_Email extends PHPUnit_Framework_TestCase {

  public function testConstructionEmail() {
    $email = new SendGrid\Email();
    $this->assertEquals(get_class($email), 'SendGrid\Email');
  }

  public function testConstructionEmailIsSendGridEmail() {
    $email = new SendGrid\Email();
    $this->assertEquals(get_class($email), 'SendGrid\Email');
  }

  public function testAddToWithDeprectedEmailClass() {
    $mail = new SendGrid\Email();

    $mail->addSmtpapiTo('p1@mailinator.com');
    $this->assertEquals(['p1@mailinator.com'], $mail->getSmtpapi()->to);

    $mail->addSmtpapiTo('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $mail->getSmtpapi()->to);
  }

  public function testAddTo() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com');
    $this->assertEquals(['p1@mailinator.com'], $email->to);

    $email->addTo('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $email->to);
  }

  public function testAddSmtpapiTo() {
    $email = new SendGrid\Email();

    $email->addSmtpapiTo('p1@mailinator.com');
    $this->assertEquals(['p1@mailinator.com'], $email->getSmtpapi()->to);

    $email->addSmtpapiTo('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $email->getSmtpapi()->to);
  }

  public function testAddToWithName() {
    $email = new SendGrid\Email();

    $email->addTo('p1@mailinator.com', 'Person One');
    $this->assertEquals(['p1@mailinator.com'], $email->to);
    $this->assertEquals(['Person One'], $email->toName);

    $email->addTo('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $email->to);
    $this->assertEquals(['Person One'], $email->toName);
  }

  public function testAddSmtpapiToWithName() {
    $email = new SendGrid\Email();

    $email->addSmtpapiTo('p1@mailinator.com', 'Person One');
    $this->assertEquals(['Person One <p1@mailinator.com>'], $email->getSmtpapi()->to);

    $email->addSmtpapiTo('p2@mailinator.com');
    $this->assertEquals([
      'Person One <p1@mailinator.com>',
      'p2@mailinator.com',
    ], $email->getSmtpapi()->to);
  }

  public function testAddToWithArray() {
    $email = new SendGrid\Email();

    $email->addTo(['foo@bar.com', 'bar@bar.com']);
    $this->assertEquals(['foo@bar.com', 'bar@bar.com'], $email->to);

    $email->addTo('baz@bar.com');
    $this->assertEquals([
      'foo@bar.com',
      'bar@bar.com',
      'baz@bar.com',
    ], $email->to);
  }

  public function testAddToWithArrayAndName() {
    $email = new SendGrid\Email();

    $email->addTo(['foo@bar.com', 'bar@bar.com'], ['Mike Foo', 'Joe Bar']);
    $this->assertEquals(['Mike Foo', 'Joe Bar'], $email->toName);

    $email->addTo('baz@bar.com', 'Ben Baz');
    $this->assertEquals(['Mike Foo', 'Joe Bar', 'Ben Baz'], $email->toName);
  }

  public function testAddToName() {
    $email = new SendGrid\Email();

    $email->addToName('Foo Bar');
    $this->assertEquals(['Foo Bar'], $email->toName);

    $email->addToName('Baz Bar');
    $this->assertEquals(['Foo Bar', 'Baz Bar'], $email->toName);
  }


  public function testSetTos() {
    $email = new SendGrid\Email();

    $email->setTos(['foo@bar.com', 'baz@bar.com']);
    $this->assertEquals(['foo@bar.com', 'baz@bar.com'], $email->to);
  }

  public function testSetSmtpapiTo() {
    $email = new SendGrid\Email();

    $email->setSmtpapiTos(['p1@mailinator.com']);
    $this->assertEquals(['p1@mailinator.com'], $email->getSmtpapi()->to);
  }

  public function testSetSmtpapiTos() {
    $email = new SendGrid\Email();

    $email->setSmtpapiTos(['p1@mailinator.com']);
    $this->assertEquals(['p1@mailinator.com'], $email->getSmtpapi()->to);
  }

  public function testRemoveTo() {
    $email = new SendGrid\Email();

    $email->addSmtpapiTo('p1@mailinator.com');
    $this->assertEquals(['p1@mailinator.com'], $email->getSmtpapi()->to);
  }

  public function testSetFrom() {
    $email = new SendGrid\Email();

    $email->setFrom('foo@bar.com');
    $email->setFromName('John Doe');

    $this->assertEquals('foo@bar.com', $email->getFrom());
    $this->assertEquals(['foo@bar.com' => 'John Doe'], $email->getFrom(TRUE));
  }

  public function testSetFromName() {
    $email = new SendGrid\Email();

    $this->assertFalse($email->getFromName());
    $email->setFromName('Swift');
    $this->assertEquals('Swift', $email->getFromName());
  }

  public function testSetReplyTo() {
    $email = new SendGrid\Email();

    $this->assertFalse($email->getReplyTo());
    $email->setReplyTo('swift@sendgrid.com');
    $this->assertEquals('swift@sendgrid.com', $email->getReplyTo());
  }

  public function testSetCc() {
    $email = new SendGrid\Email();

    $email->setCc('p1@mailinator.com');
    $email->setCc('p2@mailinator.com');

    $this->assertEquals(1, count($email->getCcs()));
    $cc = $email->getCcs();
    $this->assertEquals('p2@mailinator.com', $cc[0]);
  }

  public function testSetCcs() {
    $email = new SendGrid\Email();

    $email->setCcs(['raz@mailinator.com', 'ber@mailinator.com']);

    $this->assertEquals(2, count($email->getCcs()));

    $cc = $email->getCcs();

    $this->assertEquals('raz@mailinator.com', $cc[0]);
    $this->assertEquals('ber@mailinator.com', $cc[1]);
  }

  public function testAddCc() {
    $email = new SendGrid\Email();

    $email->addCc('foo@bar.com');
    $email->addCc('raz@bar.com');

    $this->assertEquals(2, count($email->getCcs()));

    $cc = $email->getCcs();

    $this->assertEquals('foo@bar.com', $cc[0]);
    $this->assertEquals('raz@bar.com', $cc[1]);

    // removeCc removes all occurences of data
    $email->removeCc('raz@bar.com');

    $this->assertEquals(1, count($email->getCcs()));

    $cc = $email->getCcs();

    $this->assertEquals('foo@bar.com', $cc[0]);
  }

  public function testAddCcWithName() {
    $email = new SendGrid\Email();

    $email->addCc('p1@mailinator.com', 'Person One');
    $this->assertEquals(['p1@mailinator.com'], $email->cc);
    $this->assertEquals(['Person One'], $email->ccName);

    $email->addCc('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $email->cc);
    $this->assertEquals(['Person One'], $email->ccName);
  }

  public function testAddCcName() {
    $email = new SendGrid\Email();

    $email->addCcName('Foo Bar');
    $this->assertEquals(['Foo Bar'], $email->ccName);

    $email->addCcName('Baz Bar');
    $this->assertEquals(['Foo Bar', 'Baz Bar'], $email->ccName);
  }

  public function testSetBcc() {
    $email = new SendGrid\Email();

    $email->setBcc('bar');
    $email->setBcc('foo');
    $this->assertEquals(1, count($email->getBccs()));

    $bcc = $email->getBccs();
    $this->assertEquals('foo', $bcc[0]);
  }

  public function testSetBccs() {
    $email = new SendGrid\Email();

    $email->setBccs(['raz', 'ber']);
    $this->assertEquals(2, count($email->getBccs()));

    $bcc = $email->getBccs();
    $this->assertEquals('raz', $bcc[0]);
    $this->assertEquals('ber', $bcc[1]);
  }

  public function testAddBcc() {
    $email = new SendGrid\Email();

    $email->addBcc('foo');
    $email->addBcc('raz');
    $this->assertEquals(2, count($email->getBccs()));

    $bcc = $email->getBccs();
    $this->assertEquals('foo', $bcc[0]);
    $this->assertEquals('raz', $bcc[1]);

    $email->removeBcc('raz');

    $this->assertEquals(1, count($email->getBccs()));
    $bcc = $email->getBccs();
    $this->assertEquals('foo', $bcc[0]);
  }

  public function testAddBccWithName() {
    $email = new SendGrid\Email();

    $email->addBcc('p1@mailinator.com', 'Person One');
    $this->assertEquals(['p1@mailinator.com'], $email->bcc);
    $this->assertEquals(['Person One'], $email->bccName);

    $email->addBcc('p2@mailinator.com');
    $this->assertEquals([
      'p1@mailinator.com',
      'p2@mailinator.com',
    ], $email->bcc);
    $this->assertEquals(['Person One'], $email->bccName);
  }

  public function testAddBccName() {
    $email = new SendGrid\Email();

    $email->addBccName('Foo Bar');
    $this->assertEquals(['Foo Bar'], $email->bccName);

    $email->addBccName('Baz Bar');
    $this->assertEquals(['Foo Bar', 'Baz Bar'], $email->bccName);
  }

  public function testSetSubject() {
    $email = new SendGrid\Email();

    $email->setSubject('Test Subject');
    $this->assertEquals('Test Subject', $email->getSubject());
  }

  public function testSetDate() {
    $email = new SendGrid\Email();

    date_default_timezone_set('America/Los_Angeles');
    $date = date('r');
    $email->setDate($date);
    $this->assertEquals($date, $email->getDate());
  }

  public function testSetSendAt() {
    $email = new SendGrid\Email();

    $email->setSendAt(1409348513);
    $this->assertEquals('{"send_at":1409348513}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testSetSendEachAt() {
    $email = new SendGrid\Email();

    $email->setSendEachAt([1409348513, 1409348514, 1409348515]);
    $this->assertEquals('{"send_each_at":[1409348513,1409348514,1409348515]}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testAddSendEachAt() {
    $email = new SendGrid\Email();
    $email->addSendEachAt(1409348513);
    $email->addSendEachAt(1409348514);
    $email->addSendEachAt(1409348515);
    $this->assertEquals('{"send_each_at":[1409348513,1409348514,1409348515]}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testSetTemplateId() {
    $email = new SendGrid\Email();
    $email->setTemplateId('123-456');
    $filter = [
      'templates' => [
        'settings' => [
          'enabled' => 1,
          'template_id' => '123-456',
        ],
      ],
    ];
    $this->assertEquals($email->smtpapi->getFilters(), $filter);
  }

  public function testSetAsmGroupId() {
    $email = new SendGrid\Email();
    $email->setAsmGroupId('my_id');
    $this->assertEquals('my_id', $email->smtpapi->asm_group_id);
  }

  public function testSetText() {
    $email = new SendGrid\Email();

    $text = 'sample plain text';
    $email->setText($text);
    $this->assertEquals($text, $email->getText());
  }

  public function testSetHtml() {
    $email = new SendGrid\Email();

    $html = "<p style = 'color:red;'>Sample HTML text</p>";
    $email->setHtml($html);
    $this->assertEquals($html, $email->getHtml());
  }

  public function testSetAttachments() {
    $email = new SendGrid\Email();

    $attachments =
      [
        'path/to/file/file_1.txt',
        '../file_2.txt',
        '../file_3.txt',
      ];

    $email->setAttachments($attachments);
    $msg_attachments = $email->getAttachments();
    $this->assertEquals(count($attachments), count($msg_attachments));

    for ($i = 0; $i < count($attachments); $i++) {
      $this->assertEquals($attachments[$i], $msg_attachments[$i]['file']);
    }
  }

  public function testSetAttachmentsWithCustomFilename() {
    $email = new SendGrid\Email();

    $array_of_attachments =
      [
        'customName.txt' => 'path/to/file/file_1.txt',
        'another_name_|.txt' => "../file_2.txt",
        'custom_name_2.zip' => "../file_3.txt",
      ];

    $email->setAttachments($array_of_attachments);
    $attachments = $email->getAttachments();

    $this->assertEquals($attachments[0]['custom_filename'], 'customName.txt');
    $this->assertEquals($attachments[1]['custom_filename'], 'another_name_|.txt');
    $this->assertEquals($attachments[2]['custom_filename'], 'custom_name_2.zip');
  }

  public function testAddAttachment() {
    $email = new SendGrid\Email();

    //ensure that addAttachment appends to the list of attachments
    $email->addAttachment('../file_4.png');

    $attachments[] = '../file_4.png';

    $msg_attachments = $email->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);
  }

  public function testAddAttachmentCustomFilename() {
    $email = new SendGrid\Email();

    $email->addAttachment('../file_4.png', 'different.png');

    $attachments = $email->getAttachments();
    $this->assertEquals($attachments[0]['custom_filename'], 'different.png');
    $this->assertEquals($attachments[0]['filename'], 'file_4');
  }


  public function testSetAttachment() {
    $email = new SendGrid\Email();

    //Setting an attachment removes all other files
    $email->setAttachment('only_attachment.sad');

    $this->assertEquals(1, count($email->getAttachments()));

    //Remove an attachment
    $email->removeAttachment("only_attachment.sad");
    $this->assertEquals(0, count($email->getAttachments()));
  }

  public function testSetAttachmentCustomFilename() {
    $email = new SendGrid\Email();

    //Setting an attachment removes all other files
    $email->setAttachment('only_attachment.sad', 'different');

    $attachments = $email->getAttachments();
    $this->assertEquals(1, count($attachments));
    $this->assertEquals($attachments[0]['custom_filename'], 'different');

    //Remove an attachment
    $email->removeAttachment('only_attachment.sad');
    $this->assertEquals(0, count($email->getAttachments()));
  }

  public function testAddAttachmentWithoutExtension() {
    $email = new SendGrid\Email();

    //ensure that addAttachment appends to the list of attachments
    $email->addAttachment('../file_4');

    $attachments[] = '../file_4';

    $msg_attachments = $email->getAttachments();
    $this->assertEquals($attachments[count($attachments) - 1], $msg_attachments[count($msg_attachments) - 1]['file']);
  }

  public function testCategoryAccessors() {
    $email = new SendGrid\Email();

    $email->setCategories(['category_0']);
    $this->assertEquals('{"category":["category_0"]}', $email->getSmtpapi()
      ->jsonString());

    $categories = [
      'category_1',
      'category_2',
      'category_3',
      'category_4',
    ];

    $email->setCategories($categories);

    // uses valid json
    $this->assertEquals('{"category":["category_1","category_2","category_3","category_4"]}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testSubstitutionAccessors() {
    $email = new SendGrid\Email();

    $substitutions = [
      'sub_1' => ['val_1.1', 'val_1.2', 'val_1.3'],
      'sub_2' => ['val_2.1', 'val_2.2'],
      'sub_3' => ['val_3.1', 'val_3.2', 'val_3.3', 'val_3.4'],
      'sub_4' => ['val_4.1', 'val_4.2', 'val_4.3'],
    ];

    $email->setSubstitutions($substitutions);

    $this->assertEquals('{"sub":{"sub_1":["val_1.1","val_1.2","val_1.3"],"sub_2":["val_2.1","val_2.2"],"sub_3":["val_3.1","val_3.2","val_3.3","val_3.4"],"sub_4":["val_4.1","val_4.2","val_4.3"]}}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testSectionAccessors() {
    $email = new SendGrid\Email();

    $sections = [
      "sub_1" => ["val_1.1", "val_1.2", "val_1.3"],
      "sub_2" => ["val_2.1", "val_2.2"],
      "sub_3" => ["val_3.1", "val_3.2", "val_3.3", "val_3.4"],
      "sub_4" => ["val_4.1", "val_4.2", "val_4.3"],
    ];

    $email->setSections($sections);

    $this->assertEquals('{"section":{"sub_1":["val_1.1","val_1.2","val_1.3"],"sub_2":["val_2.1","val_2.2"],"sub_3":["val_3.1","val_3.2","val_3.3","val_3.4"],"sub_4":["val_4.1","val_4.2","val_4.3"]}}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testUniqueArgsAccessors() {
    $email = new SendGrid\Email();

    $unique_arguments = [
      'sub_1' => ['val_1.1', 'val_1.2', 'val_1.3'],
      'sub_2' => ['val_2.1', 'val_2.2'],
      'sub_3' => ['val_3.1', 'val_3.2', 'val_3.3', 'val_3.4'],
      'sub_4' => ['val_4.1', 'val_4.2', 'val_4.3'],
    ];

    $email->setUniqueArgs($unique_arguments);

    $this->assertEquals('{"unique_args":{"sub_1":["val_1.1","val_1.2","val_1.3"],"sub_2":["val_2.1","val_2.2"],"sub_3":["val_3.1","val_3.2","val_3.3","val_3.4"],"sub_4":["val_4.1","val_4.2","val_4.3"]}}', $email->getSmtpapi()
      ->jsonString());

    $email->addUniqueArg('uncle', 'bob');

    $this->assertEquals('{"unique_args":{"sub_1":["val_1.1","val_1.2","val_1.3"],"sub_2":["val_2.1","val_2.2"],"sub_3":["val_3.1","val_3.2","val_3.3","val_3.4"],"sub_4":["val_4.1","val_4.2","val_4.3"],"uncle":"bob"}}', $email->getSmtpapi()
      ->jsonString());
  }

  public function testHeaderAccessors() {
    // A new message shouldn't have any RFC-822 headers set
    $message = new SendGrid\Email();
    $this->assertEquals('{}', $message->getSmtpapi()->jsonString());

    // Add some message headers, check they are correctly stored
    $headers = [
      'X-Sent-Using' => 'SendGrid-API',
      'X-Transport' => 'web',
    ];
    $message->setHeaders($headers);
    $this->assertEquals($headers, $message->getHeaders());

    // Add another header, check if it is stored
    $message->addHeader('X-Another-Header', 'first_value');
    $headers['X-Another-Header'] = 'first_value';
    $this->assertEquals($headers, $message->getHeaders());

    // Replace a header
    $message->addHeader('X-Another-Header', 'second_value');
    $headers['X-Another-Header'] = 'second_value';
    $this->assertEquals($headers, $message->getHeaders());

    // Get the encoded headers; they must be a valid JSON
    $json = $message->getHeadersJson();
    $decoded = json_decode($json, TRUE);
    $this->assertInternalType('array', $decoded);
    // Test we get the same message headers we put in the message
    $this->assertEquals($headers, $decoded);

    // Remove a header
    $message->removeHeader('X-Transport');
    unset($headers['X-Transport']);
    $this->assertEquals($headers, $message->getHeaders());
  }

  public function testToWebFormatWithDate() {
    $email = new SendGrid\Email();
    date_default_timezone_set('America/Los_Angeles');
    $date = date('r');
    $email->setDate($date);
    $json = $email->toWebFormat();

    $this->assertEquals($json['date'], $date);
  }

  public function testToWebFormatWithSetSendAt() {
    $email = new SendGrid\Email();
    $email->setSendAt(1409348513);
    $json = $email->toWebFormat();
    $xsmtpapi = json_decode($json['x-smtpapi']);

    $this->assertEquals(1409348513, $xsmtpapi->send_at);
  }

  public function testToWebFormatWithSetSendEachAt() {
    $email = new SendGrid\Email();
    $email->setSendEachAt([1409348513, 1409348514]);
    $json = $email->toWebFormat();
    $xsmtpapi = json_decode($json['x-smtpapi']);

    $this->assertEquals([1409348513, 1409348514], $xsmtpapi->send_each_at);
  }

  public function testToWebFormatWithAddSendEachAt() {
    $email = new SendGrid\Email();
    $email->addSendEachAt(1409348513);
    $email->addSendEachAt(1409348514);
    $json = $email->toWebFormat();
    $xsmtpapi = json_decode($json['x-smtpapi']);

    $this->assertEquals([1409348513, 1409348514], $xsmtpapi->send_each_at);
  }

  public function testToWebFormatWithToName() {
    $email = new SendGrid\Email();
    $email->addTo('foo@bar.com', 'Frank Foo');
    $email->setFrom('from@site.com');
    $json = $email->toWebFormat();

    $this->assertEquals($json['toname'], ['Frank Foo']);
  }

  public function testToWebFormatWithSmtpapiTo() {
    $email = new SendGrid\Email();
    $email->addSmtpapiTo('foo@bar.com');
    $email->setFrom('from@site.com');
    $json = $email->toWebFormat();
    $xsmtpapi = json_decode($json['x-smtpapi']);

    $this->assertEquals($xsmtpapi->to, ['foo@bar.com']);
    $this->assertEquals($json['to'], 'from@site.com');
  }

  public function testToWebFormatWithCcName() {
    $email = new SendGrid\Email();
    $email->addCc('foo@bar.com', 'Frank Foo');
    $email->setFrom('from@site.com');
    $json = $email->toWebFormat();

    $this->assertEquals($json['ccname'], ['Frank Foo']);
  }

  public function testToWebFormatWithBccName() {
    $email = new SendGrid\Email();
    $email->addBcc('foo@bar.com', 'Frank Foo');
    $email->setFrom('from@site.com');
    $json = $email->toWebFormat();

    $this->assertEquals($json['bccname'], ['Frank Foo']);
  }

  public function testToWebFormatWithSmtpapiToAndBcc() {
    $email = new SendGrid\Email();
    $email->addSmtpapiTo('p1@mailinator.com');
    $email->addBcc('p2@mailinator.com');
    $json = $email->toWebFormat();

    $this->assertEquals($json['bcc'], ['p2@mailinator.com']);
    $this->assertEquals($json['x-smtpapi'], '{"to":["p1@mailinator.com"]}');
  }

  public function testToWebFormatWithAttachment() {
    $email = new SendGrid\Email();
    $email->addAttachment('./gif.gif');
    $f = pathinfo('./gif.gif');
    $json = $email->toWebFormat();
    $this->assertEquals($json['files']['gif.gif'], $f['dirname'] . '/' . $f['basename']);
  }

  public function testToWebFormatWithAttachmentAndCid() {
    $email = new SendGrid\Email();
    $email->addAttachment('./gif.gif', NULL, 'sample-cid');
    $email->addAttachment('./gif.gif', 'gif2.gif', 'sample-cid-2');
    $f = pathinfo('./gif.gif');
    $json = $email->toWebFormat();

    $this->assertEquals($json['files']['gif.gif'], $f['dirname'] . '/' . $f['basename']);
    $this->assertEquals($json['content[gif.gif]'], 'sample-cid');
    $this->assertEquals($json['content[gif2.gif]'], 'sample-cid-2');
  }

  public function testToWebFormatWithSetAttachmentAndCid() {
    $email = new SendGrid\Email();
    $email->setAttachment('./gif.gif', NULL, 'sample-cid');
    $f = pathinfo('./gif.gif');
    $json = $email->toWebFormat();

    $this->assertEquals($json['files']['gif.gif'], $f['dirname'] . '/' . $f['basename']);
    $this->assertEquals($json['content[gif.gif]'], 'sample-cid');
  }

  public function testToWebFormatWithAttachmentCustomFilename() {
    $email = new SendGrid\Email();
    $email->addAttachment('./gif.gif', 'different.jpg');
    $f = pathinfo('./gif.gif');
    $json = $email->toWebFormat();

    $this->assertEquals($json['files']['gif.gif'], $f['dirname'] . '/' . $f['basename']);
  }

  public function testToWebFormatWithHeaders() {
    $email = new SendGrid\Email();
    $email->addHeader('X-Sent-Using', 'SendGrid-API');
    $json = $email->toWebFormat();

    $headers = json_decode($json['headers'], TRUE);
    $this->assertEquals('SendGrid-API', $headers['X-Sent-Using']);
  }

  public function testToWebFormatWithFilters() {
    $email = new SendGrid\Email();
    $email->addFilter('footer', 'text/plain', 'Here is a plain text footer');
    $json = $email->toWebFormat();

    $xsmtpapi = json_decode($json['x-smtpapi'], TRUE);
    $this->assertEquals('Here is a plain text footer', $xsmtpapi['filters']['footer']['settings']['text/plain']);
  }
}
