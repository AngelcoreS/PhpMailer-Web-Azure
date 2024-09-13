<?php
// Load Composer's autoloader to automatically include necessary classes from installed dependencies
require 'vendor/autoload.php';

// Use PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Define a function to send a contact email
function send_contact_email($name, $email, $message) {

    // Validate the provided email address to ensure it's in the correct format
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        // If the email is invalid, redirect to an 'invalid email' page and stop further execution
        header('Location: invalid_email.html');
        exit(0);
    }

    // Create a new PHPMailer instance, passing `true` to enable exception handling
    $mail = new PHPMailer(true);

    try {
        // Server settings: configure PHPMailer to use SMTP for sending emails
        $mail->isSMTP();  // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';  // Specify the SMTP server to use (in this case, Gmail)
        $mail->SMTPAuth   = true;  // Enable SMTP authentication
        $mail->Username   = 'email@example.com';  // SMTP username (your Gmail account)
        $mail->Password   = 'your-app-password';  // SMTP password (App password for security)
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  // Enable TLS encryption, `ENCRYPTION_STARTTLS`
        $mail->Port       = 587;  // Set the SMTP port number for TLS (587)

        // Set the 'From' email address and name for the outgoing email
        $mail->setFrom('email@example.com', 'Web');

        // Set the 'Reply-To' email and name to the contact form data
        $mail->addReplyTo($email, $name);

        // Add a recipient for the email (in this case, sending the email back to yourself)
        $mail->addAddress('email@example.com', 'Web');

        // Set the format of the email to HTML
        $mail->isHTML(true);

        // Set the subject of the email
        $mail->Subject = 'New enquiry - Web Contact Form';

        // Set the body content of the email in HTML format, including the user's name, email, and message
        $mail->Body = "
            <h3>Hello, you got a new enquiry</h3>
            <h4>Fullname: $name</h4>
            <h4>Email: $email</h4>
            <h4>Message: $message</h4>
        ";

        // Try sending the email and handle success or failure
        if ($mail->send()) {
            // If the email is sent successfully, redirect to a thank you page
            header("Location: thankyou.html");
            exit(0);
        } else {
            // If the email fails to send, redirect back to the contact form
            header('Location: Contact.html');
            exit(0);
        }

    } catch (Exception $e) {
        // If an error occurs during the email sending process, redirect back to the contact form
        header('Location: Contact.html');
        exit(0);
    }
}
?>
