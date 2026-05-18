<?php
session_start();

$_SESSION['customer_id'] = 1;

include 'config/db.php';
include 'includes/navbar.php';

$id = $_GET['id'];

$query = mysqli_query($conn,
"SELECT * FROM products WHERE id='$id'");

$product = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Product Details</title>
</head>

<body>

<h2><?php echo $product['name']; ?></h2>

<img src="images/<?php echo $product['shirt.jpg']; ?>" width="250">

<p><?php echo $product['description']; ?></p>

<p>Price: ৳ <?php echo $product['price']; ?></p>

<p>Stock: <?php echo $product['stock']; ?></p>

<p>Gender: <?php echo $product['gender']; ?></p>

<p>Category: <?php echo $product['category']; ?></p>

<p>Size Chart: <?php echo $product['size_chart']; ?></p>

<input type="number" id="qty" value="1" min="1">

<button onclick="addToCart(
<?php echo $product['id']; ?>,
<?php echo $product['stock']; ?>
)">
Add To Cart
</button>

<script src="assets/js/cart.js"></script>

</body>
</html>