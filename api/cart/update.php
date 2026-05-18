<?php

include '../../config/db.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$cart_id = intval($data['cart_id']);
$quantity = intval($data['quantity']);

mysqli_query($conn,
"UPDATE cart
SET quantity='$quantity'
WHERE id='$cart_id'");

echo json_encode([
    "status" => "success"
]);

?>