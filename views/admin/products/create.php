<?php
    // session_start();
    require_once('../utils/auth_helper.php');
    require_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Admin</title>
    <link rel="stylesheet" href="../public/css/style.css">
</head>
<body>
    <div class="container">
        <center>
            <h2>Add new product</h2>

            <?php
                if(isset($_SESSION['product_error'])) {
                    echo "<p style='color:red'>" . htmlspecialchars($_SESSION['product_error']) . "</p>";
                    unset($_SESSION['product_error']);
                }
            ?>

            <form id="add-product-form" method="POST" action="../public/index.php?action=create_product_submit" enctype="multipart/form-data">
                <label>Product name:</label>
                <input type="text" id="prod-name" name="name" required>
                <span id="err-name" class="js-error" style="color:red;display:block;"></span><br>

                <label>Description:</label>
                <textarea name="description"></textarea> <br><br>

                <label>Size chart:</label>
                <textarea name="size_chart" placeholder="S, M, L, XL"></textarea> <br><br>

                <label>Price:</label>
                <input type="number" step="0.01" id="prod-price" name="price" required>
                <span id="err-price" class="js-error" style="color:red;display:block;"></span><br>

                <label>Category ID:</label>
                <input type="number" id="prod-category" name="category_id" required>
                <span id="err-category" class="js-error" style="color:red;display:block;"></span><br>

                <label>Stock:</label>
                <input type="number" id="prod-stock" name="stock" required>
                <span id="err-stock" class="js-error" style="color:red;display:block;"></span><br>

                <label>Gender:</label>
                <select id="prod-gender" name="gender" required>
                    <option value="">-- Select --</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                </select>
                <span id="err-gender" class="js-error" style="color:red;display:block;"></span><br>

                <label>Product image (JPEG/PNG, max 2MB):</label>
                <input type="file" id="prod-image" name="image" accept="image/jpeg,image/png">
                <span id="err-image" class="js-error" style="color:red;display:block;"></span><br>

                <input type="submit" value="Add product">
            </form>

            <br>
            <a href="../public/index.php?action=product_list">Back to product list</a>
        </center>
    </div>
    <script src="../public/js/admin.js"></script>
</body>
</html>
