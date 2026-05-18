<?php include 'includes/navbar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="filters">

    <input type="text" id="search" placeholder="Search Product">

    <select id="category">
        <option value="">All Categories</option>
        <option value="Shirts">Shirts</option>
        <option value="Pants">Pants</option>
        <option value="Salwar">Salwar</option>
        <option value="Jeans">Jeans</option>
    </select>

    <select id="gender">
        <option value="">All Gender</option>
        <option value="Men">Men</option>
        <option value="Women">Women</option>
        <option value="Kids">Kids</option>
    </select>

    <button onclick="searchProducts()">Search</button>
</div>

<div id="productGrid"></div>

<script src="assets/js/search.js"></script>
<script>
</html>