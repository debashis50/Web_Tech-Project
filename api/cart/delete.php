<?php

include '../../config/db.php';

header('Content-Type: application/json');

$cart_id = intval($_GET['id']);

mysqli_query($conn,
"DELETE FROM cart
WHERE id='$cart_id'");

echo json_encode([
    "status" => "success"
]);

?>