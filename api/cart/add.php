<?php

session_start();

include '../../config/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['customer_id'])) {

    echo json_encode([
        "status" => "error",
        "message" => "Login Required"
    ]);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$product_id = intval($data['product_id']);
$quantity = intval($data['quantity']);

$user_id = $_SESSION['customer_id'];

$productQuery = mysqli_query($conn,
"SELECT * FROM products WHERE id='$product_id'");

$product = mysqli_fetch_assoc($productQuery);

if (!$product) {

    echo json_encode([
        "status" => "error",
        "message" => "Product Not Found"
    ]);
    exit();
}

if ($quantity > $product['stock']) {

    echo json_encode([
        "status" => "error",
        "message" => "Stock Not Available"
    ]);
    exit();
}

$checkCart = mysqli_query($conn,
"SELECT * FROM cart
WHERE user_id='$user_id'
AND product_id='$product_id'");

if (mysqli_num_rows($checkCart) > 0) {

    mysqli_query($conn,
    "UPDATE cart
    SET quantity = quantity + $quantity
    WHERE user_id='$user_id'
    AND product_id='$product_id'");

} else {

    mysqli_query($conn,
    "INSERT INTO cart(user_id, product_id, quantity)
    VALUES('$user_id','$product_id','$quantity')");
}

$countQuery = mysqli_query($conn,
"SELECT SUM(quantity) as total
FROM cart
WHERE user_id='$user_id'");

$countData = mysqli_fetch_assoc($countQuery);

echo json_encode([
    "status" => "success",
    "cart_count" => $countData['total']
]);

?>