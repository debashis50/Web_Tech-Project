<?php
session_start();

if (!isset($_SESSION['customer_id'])) {
    echo json_encode([
        "status" => "error",
        "message" => "Login Required"
    ]);
    exit();
}
?>