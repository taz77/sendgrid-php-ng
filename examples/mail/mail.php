<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
use SendGrid\Client;
use SendGrid\Exception\SendgridException;
use SendGrid\Mail\Attachment;
use SendGrid\Mail\Mail;

require_once __DIR__ . '/../../sendgrid-php.php';

$email = new Mail();
try {
  $email->setFrom("test@sg.e.swingsurgeon.link", "Example User");
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}
try {
  $email->setSubject("Sending with Twilio SendGrid is Fun");
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}
try {
  $email->addTo("test@test.com", "Example User");
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}
try {
  $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}
try {
  $email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
  );
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}
try {
  $attachment = new Attachment();
  $attachment->setContent("TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12");
  $attachment->setType("application/pdf");
  $attachment->setFilename("balance_001.pdf");
  $attachment->setDisposition("attachment");
  $attachment->setContentId("Balance Sheet");
  $email->addAttachment($attachment);
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}

try {
  $attachment2 = new Attachment();
  $attachment2->setContent("BwdW");
  $attachment2->setType("image/png");
  $attachment2->setFilename("banner.png");
  $attachment2->setDisposition("inline");
  $attachment2->setContentId("Banner");
  $email->addAttachment($attachment2);
}
catch (SendgridException $e) {
  // Do something with Exception like log it.
}

$sendgrid = new Client(getenv('SENDGRID_API_KEY'));
try {
  $response = $sendgrid->send($email);
  print $response->getCode() . "\n";
  print_r($response->getBody());
  print_r($response->getHeaders());
  echo "\n";
  // print_r($response->getHeaders());
  print_r(json_encode($response->getBody(), JSON_PRETTY_PRINT));
}
catch (SendgridException $e) {
  print_r($e->getCode());
  echo "\n";
  $json = json_decode($e->getMessage());
  echo json_encode($json, JSON_PRETTY_PRINT);
  echo "\n";
}



