<?php
// Database connection parameters
$servername = "localhost";
$username = "mm_admin";
$password = "AY7i[1u";
$dbname = "mm_eladb";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$customer_info = $billing_details = $directors_info = $subscription_plan = null;
$application_stats = [];

// Retrieve total number of applications
$sql = "SELECT COUNT(*) AS total_applications FROM customer_info";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $application_stats['total_applications'] = $row['total_applications'];
} else {
    $application_stats['total_applications'] = 0;
}

// Retrieve number of processed and awaiting applications
$sql = "SELECT 
            SUM(CASE WHEN status='Approved' THEN 1 ELSE 0 END) AS processed_applications,
            SUM(CASE WHEN status='Awaiting' THEN 1 ELSE 0 END) AS awaiting_applications
        FROM customer_info";
$result = $conn->query($sql);
if ($result) {
    $row = $result->fetch_assoc();
    $application_stats['processed_applications'] = $row['processed_applications'];
    $application_stats['awaiting_applications'] = $row['awaiting_applications'];
} else {
    $application_stats['processed_applications'] = 0;
    $application_stats['awaiting_applications'] = 0;
}

// Handle form submission to retrieve specific customer data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['customer_id'])) {
    $customer_id = $conn->real_escape_string($_POST['customer_id']);

    // Retrieve Customer Information
    $sql = "SELECT * FROM customer_info WHERE id='$customer_id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $customer_info = $result->fetch_assoc();
    }

    // Retrieve Billing Details
    $sql = "SELECT * FROM billing_details WHERE customer_id='$customer_id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $billing_details = $result->fetch_assoc();
    }
}

// Close the connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode([
    'customer_info' => $customer_info,
    'billing_details' => $billing_details,
    'application_stats' => $application_stats
]);
?>
