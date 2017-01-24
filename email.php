<?php
require_once("class.phpmailer.php");
$mail             = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = 'smtp.gmail.com';      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server

$mail->Username   = 'nossocardapionc@gmail.com';  // GMAIL username
$mail->Password   = 'nossocardapio0911nc';      // GMAIL password

$mail->AddReplyTo('nossocardapionc@gmail.com','NossoCardapio');

$mail->From       = 'nossocardapionc@gmail.com';
$mail->FromName   = 'Nosso Cardapio - Site';

$mail->WordWrap   = 50; // set word wrap

// Variables
$name = trim($_POST['name']);
$email = trim($_POST['email']);
$subject = trim($_POST['subject']);
$message = trim($_POST['message']);

// Email address validation - works with php 5.2+
function is_email_valid($email) {
	return filter_var($email, FILTER_VALIDATE_EMAIL);
}

if( isset($name) && isset($email) && isset($subject) && isset($message) && is_email_valid($email) ) {

	// Email will be send
	$to = "saralonngren@gmail.com"; // Change with your email address
	$sub = "$subject - Site NossoCardapio"; // You can define email subject
	// HTML Elements for Email Body
	$body = <<<EOD
	<strong>Name:</strong> $name <br>
	<strong>Email:</strong> <a href="mailto:$email?subject=feedback" "email me">$email</a> <br> <br>
	<strong>Message:</strong> $message <br>
EOD;

//Must end on first column
	
	$headers = "From: $name <$email>\r\n";
	$headers .= 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

   $mail->MsgHTML($body);
   $mail->set("to",array());
   $mail->set("attachment",array()); 
   $mail->Subject = $sub;

   $mail->AddAddress($to,'NossoCardapio');
   $mail->Send();
	// PHP email sender
// 	mail($to, $sub, $body, $headers);
}


?>
