<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ensure this path is correct

$mail = new PHPMailer(true);

$response = ['status' => 'error', 'message' => 'Something went wrong. Please try again later.'];

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'oskartellhed90@gmail.com'; // Your Gmail username
    $mail->Password   = 'adjhzdriposgragg'; // Your app password generated
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom('oskartellhed90@gmail.com', 'Balleman'); // This email is used for authentication
    $mail->addAddress('oskartellhed90@gmail.com', 'Oskar Tellhed'); // This is where you receive the email
    $mail->addReplyTo($_POST['email'], $_POST['name']); // This sets the reply-to address to the visitor's email

    // Content
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = "From: {$_POST['name']} ({$_POST['email']})<br><br>{$_POST['message']}";
    $mail->AltBody = strip_tags("From: {$_POST['name']} ({$_POST['email']})\n\n{$_POST['message']}");

    $mail->send();
    $response['status'] = 'success';
    $response['message'] = 'Message has been sent';
} catch (Exception $e) {
    $response['message'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo json_encode($response);
?>
