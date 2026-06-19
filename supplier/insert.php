<?php
require "../config/db.php";

$sql = "INSERT INTO Supplier 
(Name, SupplierEmail, ContactNumber, Address1, City, StateProvince, PostalCode, Country, SupplierWebURL, Comments)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->execute([
    $_POST['Name'],
    $_POST['SupplierEmail'],
    $_POST['ContactNumber'],
    $_POST['Address1'],
    $_POST['City'],
    $_POST['StateProvince'],
    $_POST['PostalCode'],
    $_POST['Country'],
    $_POST['SupplierWebURL'],
    $_POST['Comments']
]);

header("Location: list.php");
exit;
?>
