<?php
    // session_start();
    require_once('../utils/auth_helper.php');
    require_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Online Clothing Brand</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h1>Admin dashboard</h1>
            <marquee>
                <p>Welcome, <?php echo $_SESSION['user_name']; ?>!</p>
            </marquee>
            
            
            <hr>
            
            <h3>Summary</h3>
            <ul>
                <li>Total products: <?php echo $total_products; ?></li>
                <li>Total customers: <?php echo $total_customers; ?></li>
                <li>Total orders: <?php echo $total_orders; ?></li>
                <li>Pending orders: <?php echo $pending_orders; ?></li>
            </ul>
            
            <hr>
            
            <h3>Manage</h3>
            <ul>
                <li><a href="../public/index.php?action=product_list">Manage products</a></li>
                <li><a href="../public/index.php?action=customer_list">Manage customers</a></li>
                <li><a href="../public/index.php?action=order_list">Manage orders</a></li>
                <li><a href="../public/index.php?action=purchase_history">View all purchase history</a></li>
            </ul>
            
            <br>
            <a href="../public/index.php?action=home">Back to home</a> |
            <a href="../public/index.php?action=logout">Logout</a>
        </center>
        
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>