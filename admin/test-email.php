<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure you have PHPMailer installed via Composer

$mail = new PHPMailer(true);

try {

$mail->isSMTP();
$mail->Host       = 'mail.ruff-ruff.com';
$mail->SMTPAuth   = true;
$mail->Username   = 'admin@ruff-ruff.com';
$mail->Password   = 'vomkox-cetxi7-bobteD';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;
$mail->SMTPAutoTLS = false; // Disable auto TLS


    // Recipients
    $mail->setFrom('admin@ruff-ruff.com', 'Your Name');
    $mail->addAddress('shahbazhaider0543@gmail.com', 'Recipient Name'); // Replace with the actual recipient email

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email from PHPMailer';
    $mail->Body    = 'This is a test email sent via PHPMailer using SMTP authentication.';
    $mail->AltBody = 'This is the plain text version of the email.';

    // Send email
    $mail->send();
    echo '✅ Email has been sent successfully!';
} catch (Exception $e) {
    echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}";
}

?>
