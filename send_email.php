<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// I-include ang PHPMailer files
require 'vendor/autoload.php'; // Kung gumamit ka ng Composer

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $remember = isset($_POST['remember']) ? 'Yes' : 'No';

    // Buoin ang mensahe
    $email_body = "
        <h2>New Customer Support Message</h2>
        <p><strong>Name:</strong> {$first_name} {$last_name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Remember Info:</strong> {$remember}</p>
        <p><strong>Message:</strong><br>{$message}</p>
    ";

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';        $mail->SMTPAuth   = true;
        $mail->Username = 'jerald02marzan@gmail.com';
        $mail->Password = 'fvgq bgyd gnlf fnks';        // Password ng email mo
        $mail->SMTPSecure = 'tls';                    // O 'ssl'
        $mail->Port       = 587;                      // Port: 587 for TLS, 465 for SSL

        // Sender & Recipient
        $mail->setFrom('jerald02marzan@gmail.com', 'Security System');
        $mail->addAddress('ediane.mike@gmail.com'); // Recipient (ikaw ito)

        // Email content
        $mail->isHTML(true);
        $mail->Subject = "Customer Support from {$first_name} {$last_name}";
        $mail->Body    = $email_body;

        $mail->send();
        echo "Message sent successfully.";
    } catch (Exception $e) {
        echo "Message sending failed. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
