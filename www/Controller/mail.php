<?php
$to      = 'aloha@trah-mail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

echo (mail($to, $subject, $message, $headers));
?>
This is a mailer
