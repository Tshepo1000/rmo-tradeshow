<?php
require "../config/db.php";

$currentPage = basename($_SERVER['PHP_SELF']);
$error = "";
$success = "";

// ==========================================
// 1. FETCH THE SUPPLIER DATA (GET REQUEST)
// ==========================================
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $supplierID = intval($_GET['id']);
    
    try {
        $query = "SELECT * FROM Supplier WHERE SupplierID = :supplierID";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':supplierID', $supplierID, PDO::PARAM_INT);
        $stmt->execute();
        $supplier = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If no supplier matched that ID, bounce back to the list
        if (!$supplier) {
            header("Location: list.php");
            exit;
        }
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} 
// ==========================================
// 2. UPDATE THE SUPPLIER DATA (POST REQUEST)
// ==========================================
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $supplierID = intval($_POST['SupplierID']);
    $name = trim($_POST['Name']);
    $email = trim($_POST['SupplierEmail']);
    $phone = trim($_POST['ContactNumber']);
    $address = trim($_POST['Address1']);
    $city = trim($_POST['City']);
    $postalCode = trim($_POST['PostalCode']);
    $province = trim($_POST['StateProvince']);
    $country = trim($_POST['Country']);
    $website = trim($_POST['SupplierWebURL']);

    // Simple backend validation check
    if (empty($name) || empty($email)) {
        $error = "Name and Email are required fields.";
    } else {
        try {
            $sql = "UPDATE Supplier SET 
                        Name = :name, 
                        SupplierEmail = :email, 
                        ContactNumber = :phone, 
                        Address1 = :address, 
                        City = :city, 
                        PostalCode = :postalCode, 
                        StateProvince = :province, 
                        Country = :country, 
                        SupplierWebURL = :website 
                    WHERE SupplierID = :supplierID";
            
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':postalCode', $postalCode);
            $stmt->bindParam(':province', $province);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':website', $website);
            $stmt->bindParam(':supplierID', $supplierID, PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                // Redirect back to list with a success token
                header("Location: list.php?updated=1");
                exit;
            } else {
                $error = "Failed to update supplier record.";
            }
        } catch (PDOException $e) {
            $error = "Database error: " . $e->getMessage();
        }
    }
}

// Redirect if neither GET ID nor POST update is happening
if (!isset($supplier) && $_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: list.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>RMO | Edit Supplier</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/rmo.png">
    <link rel="shortcut icon" sizes="192x192" href="../images/rmo.png">
</head>
<body>

<header class="header">
    <div class="logo">
        <a href="../index.php"><img src="../images/rmo.png" alt="Logo" style="height: 64px;"></a>
    </div>
    <nav class="navigation">
        <ul>
            <li><a href="../index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Dashboard</a></li>
            <li><a href="list.php" class="<?= ($currentPage == 'list.php') ? 'active' : '' ?>">Suppliers</a></li>
            <li><a href="add.php" class="<?= ($currentPage == 'add.php') ? 'active' : '' ?>">Add Suppliers</a></li>
        </ul>
    </nav>
</header>

<div class="container">
    
    <?php if (!empty($error)): ?>
        <p style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="edit.php" method="POST" class="supplier-form">
        <h2>Edit Supplier</h2>
        <!-- Hidden input to carry the ID through the post process -->
        <input type="hidden" name="SupplierID" value="<?= htmlspecialchars($supplier['SupplierID']) ?>">

            <span id="name-error" class="error"></span>
            <label for="Name">Name<span>*</span></label>
            <input type="text" id="name" name="Name" value="<?= htmlspecialchars($supplier['Name']) ?>" required>

            <span id="email-error" class="error"></span>
            <label for="SupplierEmail">Email<span>*</span></label>
            <input type="email" id="email" name="SupplierEmail" value="<?= htmlspecialchars($supplier['SupplierEmail']) ?>" required>

            <span id="contact-error" class="error"></span>
            <label for="ContactNumber">Contact Number<span>*</span></label>
            <input type="text" id="contact" name="ContactNumber" value="<?= htmlspecialchars($supplier['ContactNumber']) ?>" required>

            <span id="address-error" class="error"></span>
            <label for="Address1">Address<span>*</span></label>
            <input type="text" id="address" name="Address1" value="<?= htmlspecialchars($supplier['Address1']) ?>" required>

            <span id="city-error" class="error"></span>
            <label for="City">City<span>*</span></label>
            <input type="text" id="city" name="City" value="<?= htmlspecialchars($supplier['City']) ?>" required>

            <span id="postal-code-error" class="error"></span>
            <label for="PostalCode">Postal Code<span>*</span></label>
            <input type="text" id="postal-code" name="PostalCode" value="<?= htmlspecialchars($supplier['PostalCode']) ?>" required>

            <span id="state-error" class="error"></span>
            <label for="StateProvince">Province<span></span></label>
            <input type="text" id="state" name="StateProvince" value="<?= htmlspecialchars($supplier['StateProvince']) ?>" required>

            <span id="country-error" class="error"></span>
            <label for="Country">Country<span>*</span></label>
            <input type="text" id="country" name="Country" value="<?= htmlspecialchars($supplier['Country']) ?>" required>

            <span id="website-error" class="error"></span>
            <label for="SupplierWebURL">Website<span>*</span></label>
            <input type="text" id="website" name="SupplierWebURL" value="<?= htmlspecialchars($supplier['SupplierWebURL']) ?>" required>
        

        <input type="submit" class="save-btn" value="Update Supplier">
        <a href="list.php" class="cancel-btn" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>
    </form>
</div>

        <script>
            document.querySelector('.supplier-form').addEventListener('submit', function(event) {
                // Client-side validation scripts
                // Text pattern allows letters, numbers, spaces, and common punctuation (.,-&')
                const textPattern = /^[a-zA-Z0-9\s\.\-\,\&\']+$/; // Adjusted regex pattern

                // text pattern. Only allows letters
                const textPattern2 = /^[a-zA-Z]+$/;

                // postal-code pattern, allows numbers only
                const postalCodePattern = /^[0-9]+$/;

                // email pattern
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

                // contact number pattern, allows numbers and common formatting characters
                const contactPattern = /^\+27\-\d{2}\-\d{3}\-\d{4}$/;

                // name values for validation
                const nameInput = document.getElementById('name');
                const nameInputError = document.getElementById('name-error');

                // email values for validation
                const emailInput = document.getElementById('email');
                const emailInputError = document.getElementById('email-error');

                // contact number values for validation
                const contactInput = document.getElementById('contact');
                const contactInputError = document.getElementById('contact-error');

                // address values for validation
                const addressInput = document.getElementById('address');
                const addressInputError = document.getElementById('address-error');
                
                // city values for validation
                const cityInput = document.getElementById('city');
                const cityInputError = document.getElementById('city-error');

                // state values for validation
                const stateInput = document.getElementById('state');
                const stateInputError = document.getElementById('state-error');

                // postal code values for validation
                const postalCodeInput = document.getElementById('postal-code');
                const postalCodeInputError = document.getElementById('postal-code-error');

                // name input validation
                if (!textPattern.test(nameInput.value)) {
                    event.preventDefault();
                    nameInputError.textContent = "Please enter a valid name (letters, numbers, spaces, and . , - & ' are allowed).";
                    nameInputError.style.color = "red";
                    nameInput.focus();
                    nameInput.style.borderColor = "red";
                } else if (nameInput.value.length < 2) {
                    event.preventDefault();
                    nameInputError.textContent = "Name must be at least 2 characters long.";
                    nameInputError.style.color = "red";
                    nameInput.focus();
                    nameInput.style.borderColor = "red";
                }
                
                else {
                    nameInputError.textContent = "";
                    nameInput.style.borderColor = "";
                }

                // address input validation
                if (!textPattern.test(addressInput.value)) {
                    event.preventDefault();
                    addressInputError.textContent = "Please enter a valid address (letters, numbers, spaces, and . , - & ' are allowed).";
                    addressInputError.style.color = "red";
                    addressInput.focus();
                    addressInput.style.borderColor = "red";
                } else if (addressInput.value.length < 5) {
                    event.preventDefault();
                    addressInputError.textContent = "Address must be at least 5 characters long.";
                    addressInputError.style.color = "red";
                    addressInput.focus();
                    addressInput.style.borderColor = "red";
                } else {
                    addressInputError.textContent = "";
                    addressInput.style.borderColor = "";
                }

                // city input validation
                if (!textPattern2.test(cityInput.value)) {
                    event.preventDefault();
                    cityInputError.textContent = "Please enter a valid city name (only letters are allowed).";
                    cityInputError.style.color = "red";
                    cityInput.focus();
                    cityInput.style.borderColor = "red";
                } else if (cityInput.value.length < 2) {
                    event.preventDefault();
                    cityInputError.textContent = "City name must be at least 2 characters long.";
                    cityInputError.style.color = "red";
                    cityInput.focus();
                    cityInput.style.borderColor = "red";
                } else {
                    cityInputError.textContent = "";
                    cityInput.style.borderColor = "";
                }

                // state input validation
                if (!textPattern2.test(stateInput.value)) {
                    event.preventDefault();
                    stateInputError.textContent = "Please enter a valid state or province name (only letters are allowed).";
                    stateInputError.style.color = "red";
                    stateInput.focus();
                    stateInput.style.borderColor = "red";
                } else if (stateInput.value.length < 2) {
                    event.preventDefault();
                    stateInputError.textContent = "State or province name must be at least 2 characters long.";
                    stateInputError.style.color = "red";
                    stateInput.focus();
                    stateInput.style.borderColor = "red";
                } else {
                    stateInputError.textContent = "";
                    stateInput.style.borderColor = "";
                }

                // postal code input validation
                if (!postalCodePattern.test(postalCodeInput.value)) {
                    event.preventDefault();
                    postalCodeInputError.textContent = "Please enter a valid postal code (numbers only).";
                    postalCodeInputError.style.color = "red";
                    postalCodeInput.focus();
                    postalCodeInput.style.borderColor = "red";
                } else if (postalCodeInput.value.length < 2) {
                    event.preventDefault();
                    postalCodeInputError.textContent = "Postal code must be at least 2 characters long.";
                    postalCodeInputError.style.color = "red";
                    postalCodeInput.focus();
                    postalCodeInput.style.borderColor = "red";
                } else {
                    postalCodeInputError.textContent = "";
                    postalCodeInput.style.borderColor = "";
                }

                // email input validation
                if (!emailPattern.test(emailInput.value)) {
                    event.preventDefault();
                    emailInputError.textContent = "Please enter a valid email address.";
                    emailInputError.style.color = "red";
                    emailInput.focus();
                    emailInput.style.borderColor = "red";
                } else {
                    emailInputError.textContent = "";
                    emailInput.style.borderColor = "";
                }

                // contact number input validation
                if (!contactPattern.test(contactInput.value)) {
                    event.preventDefault();
                    contactInputError.textContent = "Please enter a valid contact number. In the format +27-XX-XXX-XXXX.";
                    contactInputError.style.color = "red";
                    contactInput.focus();
                    contactInput.style.borderColor = "red";
                } else {
                    contactInputError.textContent = "";
                    contactInput.style.borderColor = "";
                }
            });
        </script>
</body>
</html>