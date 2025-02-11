<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Load PHPMailer
require 'vendor/autoload.php'; // If installed via Composer
// OR
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST["subject"]);
    $message = htmlspecialchars($_POST["message"]);

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration for Zoho Mail
        $mail->isSMTP();
        $mail->Host = 'smtp.zoho.com';  // Zoho SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'support@techabeeb.com'; // Your Zoho email
        $mail->Password = 'W!pro@20!2'; // Use Zoho App Password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL
        $mail->Port = 465; // SMTP port for SSL (use 587 with PHPMailer::ENCRYPTION_STARTTLS)

        // Email headers and content
        $mail->setFrom('support@techabeeb.com',); // Sender email
        $mail->addAddress('support@techabeeb.com'); // Recipient email
        $mail->addReplyTo($email, $name); // Reply-to sender

        // Email subject and body
        $mail->Subject = $subject;
        $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";

        // Send email
        if ($mail->send()) {
            echo "Your message has been sent!";
        } else {
            echo "Error sending message.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
