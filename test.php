<?php
// Enable error reporting for better debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set your email variables
$to = "Bennedith@embizo.co.za";
$subject = "Test Email from cPanel";
$message = "This is a test email to check if the PHP mail() function works.";
$headers = "From: bennedith@embizo.academy\r\n";
$headers .= "Reply-To: bennedith@embizo.academy\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Define the path for logging errors (use a valid server path)
$log_file_path = "/home/username/public_html/logs/mail_error_log.txt"; // Adjust to your server structure

// Try to send the email and catch errors
if (mail($to, $subject, $message, $headers)) {
    echo "Email sent successfully!";
} else {
    echo "Failed to send the email.";
    // Log additional details in case the mail function fails
    error_log("Mail failed to send. Subject: $subject, To: $to, Headers: $headers", 3, $log_file_path);
}

// Check if mail sending failed and log the error details
if (!$mail_sent = mail($to, $subject, $message, $headers)) {
    error_log('Mail failed to send.', 3, $log_file_path);
    error_log(print_r(error_get_last(), true), 3, $log_file_path); // Log the last error
}
?>
