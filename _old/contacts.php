<?php
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message']))
{
	$to = 'axel.moussard@gmail.com';

	$subject = $_POST['subject'];
	$message = $_POST['message'] . "\n\n" . 'Regards, ' . $_POST['name'] . '.';
	$headers = 'From: ' . $_POST['name'] . "<" . $_POST['email'] . ">\r\n" . 'X-Mailer: PHP/' . phpversion();

	mail($to, $subject, $message, $headers);
	echo 'success';
} else {
	echo 'error';
}
