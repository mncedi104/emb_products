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
echo "Connected successfully";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Customer Information
    $business_type = $_POST['business_type'];
    $trading_name = $_POST['trading_name'];
    $registered_name = $_POST['registered_name'];
    $registration_number = $_POST['registration_number'];
    $date_of_registration = $_POST['date_of_registration'];
    $type_of_business = $_POST['type_of_business'];
    $physical_address = $_POST['physical_address'];
    $postal_code = $_POST['postal_code'];
    $vat_registration_number = $_POST['vat_registration_number'];
    $postal_address = $_POST['postal_address'];
    $postal_code_billing = $_POST['postal_code_billing'];
    $email_address = $_POST['email_address'];
    
    // Insert into customer_info table
    $sql = "INSERT INTO customer_info (business_type, trading_name, registered_name, registration_number, date_of_registration, type_of_business, physical_address, postal_code, vat_registration_number, postal_address, postal_code_billing, email_address) 
            VALUES ('$business_type', '$trading_name', '$registered_name', '$registration_number', '$date_of_registration', '$type_of_business', '$physical_address', '$postal_code', '$vat_registration_number', '$postal_address', '$postal_code_billing', '$email_address')";

    if ($conn->query($sql) === TRUE) {
        $customer_id = $conn->insert_id;
        echo "Customer information inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Billing Details
    $non_recurring_amount = $_POST['non_recurring_amount'];
    $non_recurring_amount_words = $_POST['non_recurring_amount_words'];
    $monthly_recurring_amount = $_POST['monthly_recurring_amount'];
    $monthly_recurring_amount_words = $_POST['monthly_recurring_amount_words'];
    $commence_date = $_POST['commence_date'];
    $bank_name = $_POST['bank_name'];
    $branch_name = $_POST['branch_name'];
    $branch_code = $_POST['branch_code'];
    $account_number = $_POST['account_number'];
    $account_holder = $_POST['account_holder'];
    $account_type = $_POST['account_type'];

    // Insert into billing_details table
    $sql = "INSERT INTO billing_details (customer_id, non_recurring_amount, non_recurring_amount_words, monthly_recurring_amount, monthly_recurring_amount_words, commence_date, bank_name, branch_name, branch_code, account_number, account_holder, account_type) 
            VALUES ('$customer_id', '$non_recurring_amount', '$non_recurring_amount_words', '$monthly_recurring_amount', '$monthly_recurring_amount_words', '$commence_date', '$bank_name', '$branch_name', '$branch_code', '$account_number', '$account_holder', '$account_type')";

    if ($conn->query($sql) === TRUE) {
        echo "Billing details inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Directors Information
    $names = $_POST['name'];
    $capacities = $_POST['capacity'];
    $id_numbers = $_POST['id_number'];
    $residential_addresses = $_POST['residential_address'];
    $postal_codes = $_POST['postal_code'];
    $telephone_numbers = $_POST['telephone_number'];
    $mobile_phone_numbers = $_POST['mobile_phone_number'];

    foreach ($names as $index => $name) {
        $capacity = $capacities[$index];
        $id_number = $id_numbers[$index];
        $residential_address = $residential_addresses[$index];
        $postal_code = $postal_codes[$index];
        $telephone_number = $telephone_numbers[$index];
        $mobile_phone_number = $mobile_phone_numbers[$index];

        // Insert into directors_info table
        $sql = "INSERT INTO directors_info (customer_id, name, capacity, id_number, residential_address, postal_code, telephone_number, mobile_phone_number) 
                VALUES ('$customer_id', '$name', '$capacity', '$id_number', '$residential_address', '$postal_code', '$telephone_number', '$mobile_phone_number')";

        if ($conn->query($sql) === TRUE) {
            echo "Director information inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

   // Subscription Plans
$subscription_plan = $_POST['subscription_plan'];
$plan_price = $_POST['plan_price'];

// Insert into subscription_plans table
$sql = "INSERT INTO subscription_plans (customer_id, subscription_plan, plan_price) 
        VALUES ('$customer_id', '$subscription_plan', '$plan_price')";

if ($conn->query($sql) === TRUE) {
    echo "Subscription plan inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

$conn->close();
?>
