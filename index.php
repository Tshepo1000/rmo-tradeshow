<?php
    // index.php
    $currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="images/rmo.png">
    <link rel="shortcut icon" sizes="192x192" href="images/rmo.png">
</head>
<body>
    <!-- Header content with navigation links and logo -->
        <header class="header">
            <div class="logo">
                <a href="index.php"><img src="images/rmo.png" alt="Ridgeline Mountain Outfitters Logo" style="height: 64px;"></a>
            </div>
            <nav class="navigation">
                <ul>
                    <li><a href="index.php" class="<?php echo ($currentPage == "index.php") ? "active" : '' ?>">Dashboard</a></li>
                    <li><a href="./supplier/list.php" class="<?php echo ($currentPage == "list.php") ? "active" : '' ?>">Suppliers</a></li>
                    <li><a href="./supplier/add.php" class="<?php echo ($currentPage == "add.php") ? "active" : '' ?>">Add Suppliers</a></li>
                </ul>
            </nav>
        </header>
</body>
</html>