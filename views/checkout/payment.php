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
    <title>Confirm Order - Online Clothing Brand</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Confirm Your Order</h2>
            <p>Please review your order one last time before confirming.</p>

            <?php if (isset($_SESSION['checkout_errors'])) { ?>
                <?php foreach ($_SESSION['checkout_errors'] as $err) { ?>
                    <p style="color:red;"><?php echo htmlspecialchars($err); ?></p>
                <?php } ?>
                <?php unset($_SESSION['checkout_errors']); ?>
            <?php } ?>

            <h3>Order Summary</h3>
            <table border="1" cellpadding="10">
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
                <?php $i = 1; foreach ($cart_items as $item) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                    <td>৳ <?php echo number_format($item['product_price'], 2); ?></td>
                    <td><?php echo $item['cart_quantity']; ?></td>
                    <td>৳ <?php echo number_format($item['product_price'] * $item['cart_quantity'], 2); ?></td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="4"><strong>Total</strong></td>
                    <td><strong>৳ <?php echo number_format($cart_total, 2); ?></strong></td>
                </tr>
            </table>

            <br>

            <table border="1" cellpadding="10">
                <tr>
                    <th>Payment Method</th>
                    <td><?php echo htmlspecialchars($payment_method); ?></td>
                </tr>
            </table>

            <br>

            <a href="../public/index.php?action=checkout_payment">
                <button type="button">Back — Change Payment</button>
            </a>
            &nbsp;&nbsp;
            <form method="POST" action="../public/index.php?action=confirm_order" style="display:inline;">
                <button type="submit">Confirm &amp; Place Order</button>
            </form>

            <br><br>
            <a href="../public/index.php?action=home">Back to Home</a>
        </center>
    </div>
</body>
</html>