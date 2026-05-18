<?php

session_start();

$_SESSION['customer_id'] = 1;

include 'config/db.php';
include 'includes/navbar.php';

$user_id = $_SESSION['customer_id'];

$query = mysqli_query($conn,
"SELECT
cart.id as cart_id,
products.id as product_id,
products.name,
products.price,
products.stock,
products.image,
cart.quantity

FROM cart

INNER JOIN products
ON cart.product_id = products.id

WHERE cart.user_id='$user_id'");

$total = 0;
?>

<!DOCTYPE html>
<html>

<head>

    <title>Cart</title>

    <style>

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        button {
            padding: 5px 10px;
            cursor: pointer;
        }

    </style>

</head>

<body>

<h2 align="center">Your Cart</h2>

<?php if(mysqli_num_rows($query) > 0) { ?>

<table>

<tr>
    <th>Image</th>
    <th>Product</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Subtotal</th>
    <th>Action</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($query)) {

    $subtotal = $row['price'] * $row['quantity'];

    $total += $subtotal;
?>

<tr>

<td>
<img src="images/<?php echo $row['image']; ?>" width="80">
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
৳ <?php echo $row['price']; ?>
</td>

<td>

<button onclick="decreaseQty(
<?php echo $row['cart_id']; ?>,
<?php echo $row['quantity']; ?>
)">
-
</button>

<span>
<?php echo $row['quantity']; ?>
</span>

<button onclick="increaseQty(
<?php echo $row['cart_id']; ?>,
<?php echo $row['quantity']; ?>,
<?php echo $row['stock']; ?>
)">
+
</button>

</td>

<td>
৳ <?php echo $subtotal; ?>
</td>

<td>

<button onclick="removeItem(
<?php echo $row['cart_id']; ?>
)">
Remove
</button>

</td>

</tr>

<?php } ?>

</table>

<h3 align="center">
Total: ৳ <?php echo $total; ?>
</h3>

<?php } else { ?>

<div style="text-align:center; margin-top:50px;">

    <h2>Your Cart is Empty</h2>

    <p>
        Looks like you haven't added any products yet.
    </p>

</div>

<?php } ?>

<div style="text-align:center; margin-top:20px;">

    <a href="home.php">

        <button style="
            padding:10px 20px;
            font-size:16px;
            cursor:pointer;
        ">
            Continue Shopping
        </button>

    </a>

</div>

<script src="assets/js/cart.js"></script>

</body>
</html>