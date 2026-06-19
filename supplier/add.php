<?php 
    //supplier/add.php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Add Suppliers</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <!-- Header content with navigation links and logo -->
        <header class="header">
            <div class="logo">
                <a href="../index.php"><img src="../images/rmo.png" alt="Ridgeline Mountain Outfitters Logo" style="height: 64px;"></a>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="../index.php" class="<?php echo ($currentPage == "index.php") ? "active" : '' ?>">Dashboard</a></li>
                    <li><a href="list.php" class="<?php echo ($currentPage == "list.php") ? "active" : '' ?>">Suppliers</a></li>
                    <li><a href="add.php" class="<?php echo ($currentPage == "add.php") ? "active" : '' ?>">Add Suppliers</a></li>
                </ul>
            </nav>
        </header>

        <div class="container">
            <form action="insert.php" method="POST" class="supplier-form">
                <h2>Add Supplier Information</h2>

                <span id="name-error" class="error"></span>
                <label for="Name">Name<span>*</span></label>
                <input id="name" type="text" name="Name" placeholder="Supplier Name" required>

                <span id="email-error" class="error"></span>
                <label for="SupplierEmail">Email<span>*</span></label>
                <input id="email" type="email" name="SupplierEmail" placeholder="Supplier Email" required>

                <span id="contact-error" class="error"></span>
                <label for="ContactNumber">Contact Number<span>*</span></label>
                <input id="contact" type="text" name="ContactNumber" placeholder="Contact Number" required>

                <span id="address-error" class="error"></span>
                <label for="Address1">Address<span>*</span></label>
                <input id="address" type="text" name="Address1" placeholder="Street Address" required>

                <span id="city-error" class="error"></span>
                <label for="City">City<span>*</span></label>
                <input id="city" type="text" name="City" placeholder="City" required>

                <span id="state-error" class="error"></span>
                <label for="StateProvince">State or Province<span>*</span></label>
                <input id="state" type="text" name="StateProvince" placeholder="State or Province" required>

                <span id="postal-code-error" class="error"></span>
                <label for="PostalCode">Postal Code<span>*</span></label>
                <input id="postal-code" type="text" name="PostalCode" placeholder="Postal Code" required>

                <span id="country-error" class="error"></span>
                <label for="Country">Country<span>*</span></label>
                <input id="country" type="text" name="Country" placeholder="Country" required>

                <span id="website-error" class="error"></span>
                <label for="SupplierWebURL">Supplier Website<span>*</span></label>
                <input id="website" type="text" name="SupplierWebURL" placeholder="Supplier Website" required>

                <span id="comments-error" class="error"></span>
                <label for="Comments">Comments</label>
                <textarea name="Comments" placeholder="Additional Comments"></textarea>

                <input type="submit" name="submit" value="Save Supplier">
            </form>
        </div>

        <script>

            document.querySelector('.supplier-form').addEventListener('submit', function(event) {
                // Client-side validation scripts
                // Text pattern allows letters, numbers, spaces, and common punctuation (.,-&')
                const textPattern = /^[a-zA-Z0-9\s\.\-\,\&\']+$/; // Adjusted regex pattern

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
                if (!textPattern.test(cityInput.value)) {
                    event.preventDefault();
                    cityInputError.textContent = "Please enter a valid city name (letters, numbers, spaces, and . , - & ' are allowed).";
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
                if (!textPattern.test(stateInput.value)) {
                    event.preventDefault();
                    stateInputError.textContent = "Please enter a valid state or province name (letters, numbers, spaces, and . , - & ' are allowed).";
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