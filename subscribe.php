<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        .text-white {
            color: #fff;
        }
        .section {
            background-color: #343a40;
        }
        .watermark {
            position: absolute;
            top: 50px;
            right: 50px;
            font-size: 2em;
            color: #ccc;
            opacity: 0.3;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
   <div class="container mt-5">
    <form id="customer-form" method="POST" action="customer.php" enctype="multipart/form-data">

        <div class="watermark">Your Watermark Text</div>

        <!-- Tab Navigation -->
        <ul class="nav nav-tabs custom-tabs" id="formTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="customer-info-tab" data-toggle="tab" href="#customer-info" role="tab" aria-controls="customer-info" aria-selected="true">Customer Information</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="billing-info-tab" data-toggle="tab" href="#billing-info" role="tab" aria-controls="billing-info" aria-selected="false">Debit Order Billing Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="directors-info-tab" data-toggle="tab" href="#directors-info" role="tab" aria-controls="directors-info" aria-selected="false">Details of Director(s)/Member(s)/Partner(s)/Owner(s)</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="subscription-plans-tab" data-toggle="tab" href="#subscription-plans" role="tab" aria-controls="subscription-plans" aria-selected="false">Subscription Plans</a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content custom-tab-content" id="formTabsContent">
            <!-- Customer Information Section -->
            <div class="tab-pane fade show active section p-4 rounded" id="customer-info" role="tabpanel" aria-labelledby="customer-info-tab">
                <h2 class="text-white">Customer Information</h2>
                <!-- Form Fields -->
                <div class="form-group">
                    <label for="business_type" class="text-white">Business Type</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="business_type" id="public_co" value="Public Co./Government" required>
                        <label class="form-check-label text-white" for="public_co">Public Co./Government</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="business_type" id="private_co" value="Private Co." required>
                        <label class="form-check-label text-white" for="private_co">Private Co.</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="business_type" id="close_corporation" value="Close Corporation" required>
                        <label class="form-check-label text-white" for="close_corporation">Close Corporation</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="business_type" id="sole_proprietorship" value="Sole Proprietorship" required>
                        <label class="form-check-label text-white" for="sole_proprietorship">Sole Proprietorship</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="trading_name" class="text-white">Trading Name</label>
                    <input type="text" class="form-control" id="trading_name" name="trading_name" placeholder="Enter Trading Name" required>
                </div>
                <div class="form-group">
                    <label for="registered_name" class="text-white">Registered Name of Co/CC</label>
                    <input type="text" class="form-control" id="registered_name" name="registered_name" placeholder="Enter Registered Name of Co/CC" required>
                </div>
                <div class="form-group">
                    <label for="registration_number" class="text-white">Registration Number of Co/CC</label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number" placeholder="Enter Registration Number of Co/CC" required>
                </div>
                <div class="form-group">
                    <label for="date_of_registration" class="text-white">Date of Registration</label>
                    <input type="date" class="form-control" id="date_of_registration" name="date_of_registration" required>
                </div>
                <div class="form-group">
                    <label for="type_of_business" class="text-white">Type of Business</label>
                    <input type="text" class="form-control" id="type_of_business" name="type_of_business" placeholder="Enter Type of Business" required>
                </div>
                <div class="form-group">
                    <label for="physical_address" class="text-white">Physical Address of Registered Office</label>
                    <input type="text" class="form-control" id="physical_address" name="physical_address" placeholder="Enter Physical Address of Registered Office" required>
                </div>
                <div class="form-group">
                    <label for="postal_code" class="text-white">Postal Code</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="Enter Postal Code" required>
                </div>

                <!-- Customer Billing Information Sub-Section -->
                <div class="customer-billing-info mt-4">
                    <h3 class="text-white">Customer Billing Information</h3>
                    <div class="form-group">
                        <label for="vat_registration_number" class="text-white">VAT Registration Number</label>
                        <input type="text" class="form-control" id="vat_registration_number" name="vat_registration_number" placeholder="Enter VAT Registration Number" required>
                    </div>
                    <div class="form-group">
                        <label for="postal_address" class="text-white">Postal Address</label>
                        <input type="text" class="form-control" id="postal_address" name="postal_address" placeholder="Enter Postal Address" required>
                    </div>
                    <div class="form-group">
                        <label for="postal_code_billing" class="text-white">Postal Code</label>
                        <input type="text" class="form-control" id="postal_code_billing" name="postal_code_billing" placeholder="Enter Postal Code" required>
                    </div>
                    <div class="form-group">
                        <label for="email_address" class="text-white">E-mail Address</label>
                        <input type="email" class="form-control" id="email_address" name="email_address" placeholder="Enter E-mail Address" required>
                    </div>
                </div>
            </div>

            <!-- Debit Order Billing Details Section -->
            <div class="tab-pane fade section p-4 rounded" id="billing-info" role="tabpanel" aria-labelledby="billing-info-tab">
                <h2 class="text-white">Debit Order Billing Details</h2>
                <p class="text-white">I/we hereby request and authorise E-mbizo to draw against my/our account held with the here within mentioned bank (or any other bank or branch to which I/we may transfer from my/our account) the Monthly sum of:</p>
                <div class="form-group">
                    <label for="non_recurring_amount" class="text-white">Non-Recurring: R</label>
                    <input type="text" class="form-control" id="non_recurring_amount" name="non_recurring_amount" placeholder="Enter Non-Recurring Amount" required>
                </div>
                <div class="form-group">
                    <label for="non_recurring_amount_words" class="text-white">Amount in Words (Non-Recurring)</label>
                    <input type="text" class="form-control" id="non_recurring_amount_words" name="non_recurring_amount_words" placeholder="Enter Amount in Words (Non-Recurring)" required>
                </div>
                <div class="form-group">
                    <label for="monthly_recurring_amount" class="text-white">Monthly Recurring: R</label>
                    <input type="text" class="form-control" id="monthly_recurring_amount" name="monthly_recurring_amount" placeholder="Enter Monthly Recurring Amount" required>
                </div>
                <div class="form-group">
                    <label for="monthly_recurring_amount_words" class="text-white">Amount in Words (Monthly Recurring)</label>
                    <input type="text" class="form-control" id="monthly_recurring_amount_words" name="monthly_recurring_amount_words" placeholder="Enter Amount in Words (Monthly Recurring)" required>
                </div>
                <div class="form-group">
                    <label for="commence_date" class="text-white">Commence Date</label>
                    <input type="date" class="form-control" id="commence_date" name="commence_date" required>
                </div>

                <!-- Banking Details -->
                <h3 class="text-white">Banking Details</h3>
                <div class="form-group">
                    <label for="bank_name" class="text-white">Bank</label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="Enter Bank Name" required>
                </div>
                <div class="form-group">
                    <label for="branch_name" class="text-white">Branch</label>
                    <input type="text" class="form-control" id="branch_name" name="branch_name" placeholder="Enter Branch Name" required>
                </div>
                <div class="form-group">
                    <label for="branch_code" class="text-white">Branch Code</label>
                    <input type="text" class="form-control" id="branch_code" name="branch_code" placeholder="Enter Branch Code" required>
                </div>
                <div class="form-group">
                    <label for="account_number" class="text-white">Account Number</label>
                    <input type="text" class="form-control" id="account_number" name="account_number" placeholder="Enter Account Number" required>
                </div>
                <div class="form-group">
                    <label for="account_holder" class="text-white">Account Holder</label>
                    <input type="text" class="form-control" id="account_holder" name="account_holder" placeholder="Enter Account Holder" required>
                </div>
                <div class="form-group">
                    <label for="account_type" class="text-white">Type of Account</label>
                    <select class="form-control" id="account_type" name="account_type" required>
                        <option value="savings">Savings</option>
                        <option value="current">Current</option>
                    </select>
                </div>
            </div>

         <!-- Details of Director(s)/Member(s)/Partner(s)/Owner(s) Section -->
<div class="tab-pane fade section p-4 rounded" id="directors-info" role="tabpanel" aria-labelledby="directors-info-tab">
    <h2 class="text-white">Details of Director(s)/Member(s)/Partner(s)/Owner(s)</h2>
    <div id="directors-container">
        <div class="director">
            <div class="form-group">
                <label for="name" class="text-white">Name</label>
                <input type="text" class="form-control" name="name[]" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
                <label for="capacity" class="text-white">Capacity</label>
                <input type="text" class="form-control" name="capacity[]" placeholder="Enter Capacity" required>
            </div>
            <div class="form-group">
                <label for="id_number" class="text-white">ID Number</label>
                <input type="text" class="form-control" name="id_number[]" placeholder="Enter ID Number" required>
            </div>
            <div class="form-group">
                <label for="residential_address" class="text-white">Residential Address</label>
                <input type="text" class="form-control" name="residential_address[]" placeholder="Enter Residential Address" required>
            </div>
            <div class="form-group">
                <label for="postal_code" class="text-white">Postal Code</label>
                <input type="text" class="form-control" name="postal_code[]" placeholder="Enter Postal Code" required>
            </div>
            <div class="form-group">
                <label for="telephone_number" class="text-white">Telephone Number</label>
                <input type="text" class="form-control" name="telephone_number[]" placeholder="Enter Telephone Number" required>
            </div>
            <div class="form-group">
                <label for="mobile_phone_number" class="text-white">Mobile Phone Number</label>
                <input type="text" class="form-control" name="mobile_phone_number[]" placeholder="Enter Mobile Phone Number" required>
            </div>
        </div>
    </div>


                <button type="button" id="add-director-btn" class="btn btn-secondary mt-3">Add Another Director</button>
            </div>
<!-- Subscription Plans Section -->
<div class="tab-pane fade section p-4 rounded" id="subscription-plans" role="tabpanel" aria-labelledby="subscription-plans-tab">
    <h2 class="text-white">Subscription Plans</h2>
    <div class="form-group">
        <label for="subscription_plan" class="text-white">Enter Plan</label>
        <input type="text" class="form-control" id="subscription_plan" name="subscription_plan" placeholder="Enter Plan Name" required>
    </div>
    <div class="form-group">
        <label for="plan_price" class="text-white">Select Plan Price</label>
        <select class="form-control" id="plan_price" name="plan_price" required>
            <option value="100">100</option>
            <option value="200">200</option>
            <option value="300">300</option>
        </select>
    </div>
</div>

        <!-- Submit Button -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="scripts.js"></script>
</body>
</html>
