<?php

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']) || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) || $_POST['name'] == '' || $_POST['email'] == '' ||  $_POST['message'] == '') {
	echo "No arguments Provided!";
	return false;
   }
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// if (empty($name) || empty($email) || empty($message)) {
//     echo "No arguments Provided!";
// 	return false;
// } else {
// Instantiate a new PHPMailer
$mail = new PHPMailer;

// Tell PHPMailer to use SMTP
$mail->isSMTP();

// Replace sender@example.com with your "From" address.
// This address must be verified with Amazon SES.
$mail->setFrom('sender@example.com', 'name');

// Replace recipient@example.com with a "To" address. If your account
// is still in the sandbox, this address must be verified.
// Also note that you can include several addAddress() lines to send
// email to multiple recipients.
$mail->addAddress('recipient@example.com', 'name');

// Replace smtp_username with your Amazon SES SMTP user name.
$mail->Username = 'smtp_username';

// Replace smtp_password with your Amazon SES SMTP password.
$mail->Password = 'smtp_password';

// Specify a configuration set. If you do not want to use a configuration
// set, comment or remove the next line.
// $mail->addCustomHeader('X-SES-CONFIGURATION-SET', 'ConfigSet');

// If you're using Amazon SES in a region other than US West (Oregon),
// replace email-smtp.us-west-2.amazonaws.com with the Amazon SES SMTP
// endpoint in the appropriate region.
$mail->Host = 'email-smtp.us-west-2.amazonaws.com';

// The subject line of the email
$mail->Subject = 'Contact form details';

// The HTML-formatted body of the email
$mail->Body = '<h1>Contact form</h1>
    <p>Contact name: ' . $_POST['name'] . '</p>
    <p>Contact email: ' . $_POST['email'] . '</p>
    <p>Contact message: ' . $_POST['message'] . '</p>';

// Tells PHPMailer to use SMTP authentication
$mail->SMTPAuth = true;

// Enable TLS encryption over port 587
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Tells PHPMailer to send HTML-formatted email
$mail->isHTML(true);

// The alternative email body; this is only displayed when a recipient
// opens the email in a non-HTML email client. The \r\n represents a
// line break.
$mail->AltBody = $name . '\n' . $email . '\n' . $message;
$mail->send();
return true;
    // header("Location: https://www.ntmk.ca");
// if(!$mail->send()) {
    // echo "Email sent!" . $name . $email . $message, PHP_EOL;
// } 
?>
