<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
use SendGrid\Mail\Attachment;
use SendGrid\Mail\GridException;
use SendGrid\Mail\Mail;
use SendGrid\Client;

require_once __DIR__ . '/../../sendgrid-php.php';

$email = new Mail();
try {
  $email->setFrom("test@sg.e.swingsurgeon.link", "Example User");
}
catch (GridException $e) {
}
try {
  $email->setSubject("Sending with Twilio SendGrid is Fun");
}
catch (GridException $e) {
}
try {
  $email->addTo("brady@fastglass.net", "Example User");
}
catch (GridException $e) {
}
try {
  $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
}
catch (GridException $e) {
}
try {
  $email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
  );
}
catch (GridException $e) {
}

$attachment = new Attachment();
$attachment->setContent("TG9yZW0gaXBzdW0gZG9sb3Igc2l0IGFtZXQsIGNvbnNlY3RldHVyIGFkaXBpc2NpbmcgZWxpdC4gQ3JhcyBwdW12");
$attachment->setType("application/pdf");
$attachment->setFilename("balance_001.pdf");
$attachment->setDisposition("attachment");
$attachment->setContentId("Balance Sheet");
$email->addAttachment($attachment);

$attachment2 = new Attachment();
$attachment2->setContent("BwdW");
$attachment2->setType("image/png");
$attachment2->setFilename("banner.png");
$attachment2->setDisposition("inline");
$attachment2->setContentId("Banner");
$email->addAttachment($attachment2);

// if(property_exists($email, 'attachments')) {
//   echo "SUCCESS";
// }

// print_r($email);
// print_r(json_encode($email, JSON_PRETTY_PRINT));




$sendgrid = new Client(getenv('SENDGRID_API_KEY'));
try {
  $response = $sendgrid->send($email);
  print $response->getCode() . "\n";
  // print_r($response->getHeaders());
  print_r(json_encode($response->getBody(), JSON_PRETTY_PRINT));
}
catch (Exception $e) {
  echo 'Caught exception: ' . $e->getCode() . "\n";
  echo 'Caught exception: ' . $e->getMessage() . "\n";
  print_r(json_encode($e->getBody(), JSON_PRETTY_PRINT));
}



