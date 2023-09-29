<?php
$useremail=$_GET['email'];
echo $useremail;
$sub=$_GET['sub'];
echo $sub;
$message=$_GET['message'];
echo $message;
require 'vendor/autoload.php'; // If you're using Composer (recommended)
// Comment out the above line if not using Composer
// require("<PATH TO>/sendgrid-php.php");
// If not using Composer, uncomment the above line and
// download sendgrid-php.zip from the latest release here,
// replacing <PATH TO> with the path to the sendgrid-php.php file,
// which is included in the download:
// https://github.com/sendgrid/sendgrid-php/releases

$email = new \SendGrid\Mail\Mail();
$email->setFrom("bpokhrel140@gmail.com", "Hamro Sahar");
$email->setSubject("$sub");
$email->addTo("$useremail", "To");
$email->addContent("text/plain", "$message");
$email->addContent(
    "text/html", "<strong>$message</strong>"
);
$sendgrid = new \SendGrid("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");
try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}?>