<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Signed Contract</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(45deg, black, blue, orange, white);
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 30px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        p, label {
            margin-bottom: 10px;
        }

        a {
            color: #1e90ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .required-docs {
            margin-top: 20px;
            padding: 15px;
            border: 1px solid #fff;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.2);
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            background-color: #1e90ff;
            color: #fff;
            font-size: 16px;
            margin-top: 10px;
        }

        button:hover {
            background-color: #1c75d8;
        }

        input[type="file"] {
            margin-top: 10px;
            padding: 5px;
        }

        input[type="checkbox"] {
            margin-right: 10px;
        }
    </style>
    <script>
        function toggleDownloadLink() {
            var checkbox = document.getElementById('policyCheckbox');
            var downloadLink = document.getElementById('downloadLink');
            var submitButton = document.querySelector('button[type="submit"]');

            if (checkbox.checked) {
                downloadLink.style.display = 'inline';
                submitButton.disabled = false;  // Enable the submit button
            } else {
                downloadLink.style.display = 'none';
                submitButton.disabled = true;  // Disable the submit button
            }
        }

        // Disable submit button on page load
        window.onload = function() {
            document.querySelector('button[type="submit"]').disabled = true;
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h1>Upload Signed Contract</h1>

        <!-- Policy Section -->
        <p>
            Please read our <a href="http://embizo.academy/emb_products/Policy.php" target="_blank">Policy</a> before proceeding.
        </p>
        <label>
            <input type="checkbox" id="policyCheckbox" onclick="toggleDownloadLink()"> I have read and agree to the policy.
        </label>

        <!-- Download Link, initially hidden -->
        <p>
            <a href="http://embizo.academy/emb_products/Contract.pdf" id="downloadLink" download="Contract.pdf" style="display:none;">Download the contract</a>, 
            fill it out, and then upload it using the form below.
        </p>

        <!-- Required Documents Section -->
        <div class="required-docs">
            <strong>Required Documents:</strong>
            <p>Contracts must be attached with the Required Regulation of Interception of Communications and Provision of Communication-Related Information Act (RICA) documents.</p>
            <h4>For Individuals:</h4>
            <ul>
                <li>Certified Copy of ID</li>
                <li>Proof of Address</li>
            </ul>
            <h4>For Businesses:</h4>
            <ul>
                <li>Certified copy of representative ID</li>
                <li>Proof of representative residential address</li>
                <li>Copy of business letterhead including registration details and address</li>
            </ul>
        </div>

        <!-- Form to upload the signed contract -->
        <form id="uploadForm" action="http://embizo.academy/emb_products/upload.php" method="post" enctype="multipart/form-data">
            <!-- Hidden fields for application_id and customer_id -->
            <input type="hidden" name="application_id" value="<?php echo htmlspecialchars($_GET['application_id'] ?? ''); ?>">
            <input type="hidden" name="customer_id" value="<?php echo htmlspecialchars($_GET['customer_id'] ?? ''); ?>">

            <label for="file">Choose file to upload:</label>
            <input type="file" id="file" name="file" required>
            
            <button type="submit">Upload</button>
        </form>

        <!-- Result Message -->
        <div id="resultMessage"></div>
    </div>
</body>
</html>
