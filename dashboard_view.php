<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <h2>Admin Panel</h2>
            <ul>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Applications</a></li>
                <li><a href="#">Billing</a></li>
                <li><a href="#">Subscriptions</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="dashboard-header">
                <h1>Customer Dashboard</h1>
            </header>
            
            <div class="dashboard-stats">
                <div class="stat-card">
                    <h3>Total Applications</h3>
                    <p id="total-applications">0</p>
                </div>
                <div class="stat-card">
                    <h3>Processed Applications</h3>
                    <p id="processed-applications">0</p>
                </div>
                <div class="stat-card">
                    <h3>Awaiting Applications</h3>
                    <p id="awaiting-applications">0</p>
                </div>
            </div>
            
            <section class="customer-section">
                <h2>Customer Information</h2>
                <form id="dashboard-form" method="POST">
                    <div class="form-group">
                        <input type="text" id="customer_id" name="customer_id" placeholder="Enter Customer ID" required>
                        <button type="submit" class="btn btn-primary">Retrieve Data</button>
                    </div>
                </form>
                
                <div class="customer-data">
                    <div class="data-section" id="customer-info">
                        <h3>Information</h3>
                        <p id="customer-info-content">No data available.</p>
                    </div>
                    <div class="data-section" id="billing-details">
                        <h3>Billing Details</h3>
                        <p id="billing-details-content">No data available.</p>
                    </div>
                </div>

                <div class="customer-actions">
                    <form id="action-form" method="POST">
                        <input type="hidden" id="action_customer_id" name="customer_id">
                        <button type="submit" name="action" value="approve" class="btn btn-success">Approve</button>
                        <button type="submit" name="action" value="decline" class="btn btn-danger">Decline</button>
                    </form>
                </div>
            </section>
        </main>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch initial statistics from server
            fetch('dashboard.php', { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('total-applications').textContent = data.application_stats.total_applications;
                    document.getElementById('processed-applications').textContent = data.application_stats.processed_applications;
                    document.getElementById('awaiting-applications').textContent = data.application_stats.awaiting_applications;
                });

            // Handle form submission for retrieving customer data
            document.getElementById('dashboard-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const customer_id = document.getElementById('customer_id').value;

                fetch('dashboard.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ customer_id })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.customer_info) {
                        document.getElementById('customer-info-content').innerHTML = formatCustomerInfo(data.customer_info);
                        document.getElementById('action_customer_id').value = data.customer_info.id; // Set the action customer ID
                    } else {
                        document.getElementById('customer-info-content').textContent = 'No data available.';
                    }

                    if (data.billing_details) {
                        document.getElementById('billing-details-content').innerHTML = formatBillingDetails(data.billing_details);
                    } else {
                        document.getElementById('billing-details-content').textContent = 'No data available.';
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            // Handle form submission for actions
            document.getElementById('action-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const customer_id = document.getElementById('action_customer_id').value;
                const action = event.submitter.value;

                fetch('process_approval.php', { // Update to use process_approval.php
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({ customer_id, action })
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.success) {
                        // Optionally refresh stats or update the UI here
                        // location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            // Function to format customer info
            function formatCustomerInfo(customer) {
                return `
                    <p><strong>ID:</strong> ${customer.id}</p>
                    <p><strong>Business Type:</strong> ${customer.business_type}</p>
                    <p><strong>Trading Name:</strong> ${customer.trading_name}</p>
                    <p><strong>Registered Name:</strong> ${customer.registered_name}</p>
                    <p><strong>Registration Number:</strong> ${customer.registration_number}</p>
                    <p><strong>Date of Registration:</strong> ${customer.date_of_registration}</p>
                    <p><strong>Type of Business:</strong> ${customer.type_of_business}</p>
                    <p><strong>Physical Address:</strong> ${customer.physical_address}</p>
                    <p><strong>Postal Code:</strong> ${customer.postal_code}</p>
                    <p><strong>VAT Registration Number:</strong> ${customer.vat_registration_number}</p>
                    <p><strong>Postal Address:</strong> ${customer.postal_address}</p>
                    <p><strong>Postal Code (Billing):</strong> ${customer.postal_code_billing}</p>
                    <p><strong>Email Address:</strong> ${customer.email_address}</p>
                    <p><strong>Status:</strong> ${customer.status}</p>
                    <p><strong>Contracts:</strong> <a href="${customer.contracts}" target="_blank">View Contract</a></p>
                `;
            }

            // Function to format billing details
            function formatBillingDetails(billing) {
                return `
                    <p><strong>Billing ID:</strong> ${billing.billing_id}</p>
                    <p><strong>Customer ID:</strong> ${billing.customer_id}</p>
                    <p><strong>Amount:</strong> ${billing.amount}</p>
                    <p><strong>Status:</strong> ${billing.status}</p>
                `;
            }
        });
    </script>
</body>
</html>
