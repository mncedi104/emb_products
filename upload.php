<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection parameters
$servername = "localhost";
$username = "mm_admin";
$password = "AY7i[1u";
$dbname = "mm_eladb";;

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for a connection error
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Initialize response
$response = ['success' => false, 'message' => ''];

// Check if form data is present
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['file']) && isset($_POST['customer_id'])) {
    $customer_id = $conn->real_escape_string($_POST['customer_id']);
    $target_dir = "contracts/";  // Folder name for uploads
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;

    // Check if file is a valid document type
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($fileType != "pdf" && $fileType != "doc" && $fileType != "docx") {
        $response['message'] = 'Sorry, only PDF, DOC & DOCX files are allowed.';
        $uploadOk = 0;
    }

    // Check if file was successfully uploaded
    if ($uploadOk && move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        // Update the contracts column with the file path
        $sql = "UPDATE customer_info SET contracts='$target_file' WHERE id='$customer_id'";
        if ($conn->query($sql) === TRUE) {
            $response['success'] = true;
            $response['message'] = 'File has been uploaded and recorded successfully.';
        } else {
            $response['message'] = 'Error updating database: ' . $conn->error;
        }
    } else {
        $response['message'] = 'Sorry, there was an error uploading your file.';
    }
} else {
    $response['message'] = 'Customer ID or file is missing.';
}

// Close the database connection
$conn->close();

// Return the response as JSON and force it to display in the browser
header('Content-Type: application/json');
echo json_encode($response);
?>
