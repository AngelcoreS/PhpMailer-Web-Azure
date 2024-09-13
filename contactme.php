<?php
// Require the file from the secure /includes directory

// The file that processes the form with PHPMailer which is out of webserver root
//This ensures that the file is not directly accessible via a browser
require_once '../includes/sendemail.php';  
// Form processing logic if you access this file from submitbottom will continue else (type directly the url) redirect 
if (isset($_POST['SubmitContact'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Call a function from contact.php to send the email using PHPMailer
    send_contact_email($name, $email, $message);

    // Redirect to a thank you page
    header('Location: thankyou.html');
    exit();
} else {
    header('Location: Contact.html');
    exit(0);
}
