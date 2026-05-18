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
    <title>Order List - Admin</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Order list</h2>

            <?php
                if(isset($_GET['msg'])) {
                    if($_GET['msg'] == 'success') {
                        echo "<p style='color:green'>Order status updated successfully!</p>";
                    } elseif($_GET['msg'] == 'error') {
                        echo "<p style='color:red'>Failed to update order status!</p>";
                    }
                }
            ?>

            <table border="1" cellpadding="10">
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
                <?php foreach($orders as $order) { ?>
                <tr>
                    <td><?php echo $order['order_id']; ?></td>
                    <td><?php echo htmlspecialchars($order['user_name']); ?></td>
                    <td><?php echo $order['order_total_amount']; ?></td>
                    <td class="order-status-cell"><?php echo $order['order_status']; ?></td>
                    <td><?php echo $order['order_date']; ?></td>
                    <td class="order-action-cell">
                        <?php if($order['order_status'] == 'pending') { ?>
                            <form class="order-status-form" style="display:inline;">
                                <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                <button type="submit" name="status" value="confirmed">Confirm</button>
                                <button type="submit" name="status" value="rejected">Reject</button>
                            </form>
                        <?php } else { ?>
                            -
                            <!-- Once an order is confirmed or rejected, admin cannot change it again. The dash - means "no action available". -->
                        <?php } ?>
                    </td>
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
