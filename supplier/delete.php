<?php
require "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!isset($_POST["SupplierID"]) || !is_numeric($_POST["SupplierID"])) {
        die("Invalid SupplierID.");
    }

    $supplierID = intval($_POST["SupplierID"]);

    try {
        // 1. Use the correct PDO variable ($db) and query syntax
        $sql = "DELETE FROM Supplier WHERE SupplierID = :supplierID";
        $stmt = $db->prepare($sql);
        
        // 2. Bind the parameter safely using PDO syntax to prevent SQL injection
        $stmt->bindParam(':supplierID', $supplierID, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            // Success redirect back to your working list view
            header("Location: list.php?deleted=1");
            exit;
        } else {
            die("Error executing delete query.");
        }
    } catch (PDOException $e) {
        die("Database error occurred: " . $e->getMessage());
    }
}

// If someone attempts to open delete.php directly via GET request
header("Location: list.php");
exit;
?>