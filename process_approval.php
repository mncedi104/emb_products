<?php
// Database connection parameters
$servername = "localhost";
$username = "mm_admin";
$password = "AY7i[1u";
$dbname = "mm_eladb";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Initialize the response array
$response = ['success' => false, 'message' => ''];

// Check if the customer ID and action are provided
if (!empty($_POST['customer_id']) && !empty($_POST['action'])) {
    $customer_id = $conn->real_escape_string($_POST['customer_id']);
    $action = $conn->real_escape_string($_POST['action']);

    // Retrieve the customer's email based on the customer ID
    $sql = "SELECT email_address FROM customer_info WHERE id='$customer_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $to = $row['email_address'];

        // Proceed if email is available
        if ($to) {
            $subject = "Your Application Has Been Approved";
            $plain_message = "Dear Customer,\n\nYour application has been approved. Please complete the form using the link: http://embizo.academy/emb_products/form-upload.php?customer_id=$customer_id\n\nThank you.";
           $html_message = "<html><body><p>Dear Customer,</p><p>Your application has been approved. Please complete the form using this link: <a href='http://embizo.academy/emb_products/form-upload.php?customer_id=$customer_id'>Form Upload</a></p><p>Thank you.</p></body></html>";

            // Email headers
            $headers = "From: Bennedith@embizo.academy\r\n";
            $headers .= "Reply-To: Bennedith@embizo.academy\r\n";
            $headers .= "Return-Path: Bennedith@embizo.academy\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: multipart/alternative; boundary=\"PHP-alt-".md5(time())."\"\r\n";

            // Construct the email message with both plain text and HTML versions
            $message = "--PHP-alt-".md5(time())."\r\n";
            $message .= "Content-Type: text/plain; charset=UTF-8\r\n";
            $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $message .= $plain_message . "\r\n";
            $message .= "--PHP-alt-".md5(time())."\r\n";
            $message .= "Content-Type: text/html; charset=UTF-8\r\n";
            $message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $message .= $html_message . "\r\n";
            $message .= "--PHP-alt-".md5(time())."--";

            // Handle the 'approve' action
            if ($action == 'approve') {
                // Send the email
                if (mail($to, $subject, $message, $headers)) {
                    // Update customer status to 'Approved'
                    $sql_update = "UPDATE customer_info SET status='Approved' WHERE id='$customer_id'";
                    if ($conn->query($sql_update) === TRUE) {
                        $response['success'] = true;
                        $response['message'] = "Approval email sent and status updated successfully.";
                    } else {
                        $response['message'] = "Failed to update status: " . $conn->error;
                    }
                } else {
                    $response['message'] = "Failed to send approval email.";
                }
            } else if ($action == 'decline') {
                // Handle the 'decline' action (if needed)
                // Add decline logic here if necessary
                $response['success'] = true;
                $response['message'] = "Decline action not implemented.";
            }
        } else {
            $response['message'] = "No email address found for the provided customer ID.";
        }
    } else {
        $response['message'] = "No customer found with the provided ID.";
    }
} else {
    $response['message'] = "Customer ID or action is missing.";
}

// Close the database connection
$conn->close();

// Return the response as JSON
echo json_encode($response);
?>
