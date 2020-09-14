<?php

// Next line will load dependencies to run this example
// Please refer to the README how to use in your project
use SendGrid\Mail\GridException;
use SendGrid\Mail\Mail;

require_once __DIR__ . '/../../sendgrid-php.php';

$email = new Mail();
try {
  $email->setFrom("test@example.com", "Example User");
}
catch (GridException $e) {
}
try {
  $email->setSubject("Sending with Twilio SendGrid is Fun");
}
catch (GridException $e) {
}
try {
  $email->addTo("test@example.com", "Example User");
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

print_r(json_encode($email, JSON_PRETTY_PRINT));



//
// $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'));
// try {
//   $response = $sendgrid->send($email);
//   print $response->statusCode() . "\n";
//   print_r($response->headers());
//   print $response->body() . "\n";
// }
// catch (Exception $e) {
//   echo 'Caught exception: ' . $e->getMessage() . "\n";
// }



