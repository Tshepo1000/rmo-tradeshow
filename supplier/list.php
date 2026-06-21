<?php
    require "../config/db.php";

    // Fetch all suppliers
    $query = "SELECT * FROM Supplier ORDER BY SupplierID ASC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier List</title>
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


<div class="list-container">
    <h2>Supplier List</h2>

    <a href="add.php" class="add-btn">+ Add New Supplier</a>

    <table>
        <tr>
            <th>Supplier ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Address</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Province</th>
            <th>Country</th>
            <th>Website</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($suppliers as $s): ?>
            <tr>
                <td><?= htmlspecialchars($s['SupplierID']) ?></td>
                <td><?= htmlspecialchars($s['Name']) ?></td>
                <td><?= htmlspecialchars($s['SupplierEmail']) ?></td>
                <td><?= htmlspecialchars($s['ContactNumber']) ?></td>
                <td><?= htmlspecialchars($s['Address1']) ?></td>
                <td><?= htmlspecialchars($s['City']) ?></td>
                <td><?= htmlspecialchars($s['PostalCode']) ?></td>
                <td><?= htmlspecialchars($s['StateProvince']) ?></td>
                <td><?= htmlspecialchars($s['Country']) ?></td>
                <td><a href="<?= htmlspecialchars($s['SupplierWebURL']) ?>" target="_blank">
                    <?= htmlspecialchars($s['SupplierWebURL']) ?>
                </a></td>
                <td><?= $s['CreatedAt'] ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="edit.php?id=<?= $s['SupplierID'] ?>" class="edit-btn">Edit</a>
                        <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                            <input type="hidden" name="SupplierID" value="<?php echo $s['SupplierID']; ?>">
                            <button type="submit" class="delete-btn" style="cursor: pointer; border-radius: 5px; padding: 5px 10px; color: white; border: none;">Delete</button>
                        </form>
                    </div>
                </td>
                </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>
