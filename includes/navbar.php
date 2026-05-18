<?php

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include __DIR__ . '/../config/db.php';

$cart_count = 0;

if(isset($_SESSION['customer_id'])){

    $user_id = $_SESSION['customer_id'];

    $countQuery = mysqli_query($conn,
    "SELECT SUM(quantity) as total
    FROM cart
    WHERE user_id='$user_id'");

    $countData = mysqli_fetch_assoc($countQuery);

    $cart_count = $countData['total'];

    if($cart_count == NULL){
        $cart_count = 0;
    }
}
?>

<div style="
    padding:20px;
    background:#eee;
">

    <a href="home.php"
       style="margin-right:20px;">
       Home
    </a>

    <a href="cart.php">
        Cart (<?php echo $cart_count; ?>)
    </a>

</div>