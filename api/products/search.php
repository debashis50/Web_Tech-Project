<?php
include '../../config/db.php';

$q = $_GET['q'] ?? '';
$category = $_GET['category'] ?? '';
$gender = $_GET['gender'] ?? '';

$sql = "SELECT * FROM products WHERE 1";

if ($q != '') {
    $sql .= " AND name LIKE '%$q%'";
}

if ($category != '') {
    $sql .= " AND category='$category'";
}

if ($gender != '') {
    $sql .= " AND gender='$gender'";
}

$result = mysqli_query($conn, $sql);

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode($products);
?>