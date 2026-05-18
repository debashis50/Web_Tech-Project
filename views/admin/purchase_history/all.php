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
    <title>All purchase history - Admin</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>All purchase history</h2>

            

            

            <table border="1" cellpadding="10">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                </tr>
                <?php foreach($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo $order['user_name']; ?></td>
                    <td><?php echo $order['order_total_amount']; ?></td>
                    <td><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                </tr>
                <?php } ?>
            </table>

            <br>
            <a href="../public/index.php?action=admin_dashboard">Back to dashboard</a>
        </center>
        
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>