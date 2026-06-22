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
    <title>RMO | Supplier List</title>
    <link href="../css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/rmo.png">
    <link rel="shortcut icon" sizes="192x192" href="../images/rmo.png">
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

        <div style="display: flex; justify-content: space-between;">
            <a href="add.php" class="add-btn">+ Add New Supplier</a>
            <!-- Search Box Container -->
            <input type="text" id="searchInput" onkeyup="filterSuppliers()" placeholder="Search by Supplier ID, Supplier Name, Email, or City..." style="padding: 10px 20px; width: 100%; max-width: 400px; border: 1px solid #ccc; border-radius: 5px; font-size: 14px; margin-bottom: 1rem;"> 
        </div>

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

    <script>
        function filterSuppliers() {
            // 1. Get the search input value and convert to lowercase for case-insensitive matching
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            
            // 2. Target the table rows
            const table = document.querySelector(".list-container table");
            const tr = table.getElementsByTagName("tr");

            // 3. Loop through all table rows (skipping the header row at index 0)
            for (let i = 1; i < tr.length; i++) {
                // Fetch cells for Name (column 2), Email (column 3), and City (column 6)
                const idCell    = tr[i].getElementsByTagName("td")[0];
                const nameCell = tr[i].getElementsByTagName("td")[1];
                const emailCell = tr[i].getElementsByTagName("td")[2];
                const cityCell = tr[i].getElementsByTagName("td")[5];
                
                if (idCell || nameCell || emailCell || cityCell) {
                    const idText    = idCell.textContent || idCell.innerText;
                    const nameText = nameCell.textContent || nameCell.innerText;
                    const emailText = emailCell.textContent || emailCell.innerText;
                    const cityText = cityCell.textContent || cityCell.innerText;

                    // 4. If the search query matches any of these fields, show the row; otherwise, hide it
                    if (
                        idText.toLowerCase().indexOf(filter) > -1 ||
                        nameText.toLowerCase().indexOf(filter) > -1 || 
                        emailText.toLowerCase().indexOf(filter) > -1 ||
                        cityText.toLowerCase().indexOf(filter) > -1
                    ) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>

</body>
</html>
