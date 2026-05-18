<?php
    // session_start();
    require_once('../utils/auth_helper.php');
    require_customer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Placed - Online Clothing Brand</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Order Placed Successfully!</h2>
            <p>Thank you, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!</p>
            <p>Your order has been received and is currently <strong>pending</strong> confirmation by our team.</p>

            <table border="1" cellpadding="10">
                <tr>
                    <th>Order ID</th>
                    <td><?php echo htmlspecialchars($order_id); ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>Pending</td>
                </tr>
            </table>

            <br>
            <p>You can track your order status in your purchase history.</p>

            <a href="../public/index.php?action=my_orders">
                <button type="button">View My Orders</button>
            </a>
            &nbsp;&nbsp;
            <a href="../public/index.php?action=home">
                <button type="button">Continue Shopping</button>
            </a>
        </center>
    </div>
</body>
</html>